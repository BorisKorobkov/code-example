# Microservice Payment

## API endpoint

Integration with 3d party online payment gates with a bank card, PayPal, SEPA, bitcoin, etc.

* /payment - payment
  * GET / - get all possible payment methods 
    * Response: JSON (id, name, URL, etc.)
  * POST / - confirmation of payment from a payment service
    * POST /paypal, etc.
      * POST[user_id, amount, query_control_sum] 

## DB

### payment

* id,
* payment_method (by cash in a terminal, a bank card in a terminal, a bank card online, PayPal, SEPA, etc.),
* amount,
* sport_reservation_id,
* timestamp
