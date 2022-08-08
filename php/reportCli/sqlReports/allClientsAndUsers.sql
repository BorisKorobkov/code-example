SELECT client.id   AS client_id,
       client.name AS client_name,
       user.id     AS user_id,
       user.name   AS user_name

# "LEFT JOIN" - all clients (also without users)
FROM client

         LEFT JOIN user
                   ON client.id = user.client_id

ORDER BY client.id
