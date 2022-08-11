# Bookstore

The task is from [https://www.youtube.com/watch?v=gNQ9-kgyHfo](https://www.youtube.com/watch?v=gNQ9-kgyHfo), but the solution is different.

## Backend API

### Microservice User

See details in [Microservice User](./microservice_user.md).

### Microservice Payment

See details in [Microservice Payment](./microservice_payment.md). Plus offline-payment "Cash on delivery".

### Microservice Webshop

* /category
  * GET - list of all categories 
      * Response: JSON (id, parent_id, name, url, etc.)

* /author
  * GET - list of all authors 
      * Response: JSON (id, name, etc.)

* /book
  * GET - list of books, filtered by category, author, type, with pagination, etc.
    * GET[category_id (optional), author_id (optional), page (optional), limit (optional), etc.]
    * Response: JSON (id, name, author, price)

* /order
  * GET - list of previous orders and books
    * Response: JSON (id, price, date, workflow_status, array of books [id, name, quantity, price])
  * /basket - basket (unfinished order)
    * GET - list of books in the basket, etc.
      * Response: JSON (id, name, quantity, price)
    * POST - add book to the basket
      * POST[book_id, quantity]
    * PUT - modify quantity of books in the basket
      * POST[array of [book_id, quantity]]

### Microservice Search

* /search
  * GET - list of books, categories, authors, etc.
    * Response: JSON (name, type, url)

### Microservice Back-office

* Insert / update categories, books
* See all orders, change orders.status

## DB

See details in [Microservice User](./microservice_user.md) and [Microservice Payment](./microservice_payment.md).

### category

* id,
* parent_id,
* name
* url,
* etc.

### book_category

* id,
* book_id,
* category_id

### book

* id,
* name,
* year,
* isbn,
* price,
* quantity,
* etc.

### book_author

* id,
* book_id,
* author_id

### author

* id,
* name,
* etc.

### order

* id,
* user_id,
* workflow_status
* price

### order_row

* id
* order_id
* book_id
* quantity
* price

## Frontend

### Mobile app, website

* Show categories (GET /category) in a tree, authors (GET /author), etc.
* Show books and prices (GET /book)
* Create an order (POST /order)
* Login or create an account, receive a token (POST /user/login, GET /user/oauth2/..., POST /user)
* Finish the order and pay it (GET /payment, go to a payment gate, pay, POST /payment/...)

## System design

* Frontend (several)
  * website,
  * mobile app (Android, iOS, Windows),
  * back-office (for managers)
* Backend (several)
  * microservice User,
  * microservice Payment,
  * microservice Webshop,
  * microservice Back-office
* DB
  * master (one), write only 
  * slave (several), read only
