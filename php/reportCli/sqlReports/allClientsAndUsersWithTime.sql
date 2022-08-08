SELECT client.id                                         AS client_id,
       client.name                                       AS client_name,
       user.id                                           AS user_id,
       user.name                                         AS user_name,
       TIMESTAMPDIFF(MINUTE, log.startdate, log.enddate) AS minutes

# "LEFT JOIN" - all clients (also without users), all users (also inactive)
FROM client

         LEFT JOIN user
                   ON client.id = user.client_id

         LEFT JOIN log
                   ON user.id = log.user_id
                       # session can be active (started, but not finished yet). We can't calculate it.
                       AND log.startdate IS NOT NULL
                       AND log.enddate IS NOT NULL
                       # Idiot-proof
                       AND log.startdate <= log.enddate

GROUP BY client.id,
         client.name,
         user.id,
         user.name
