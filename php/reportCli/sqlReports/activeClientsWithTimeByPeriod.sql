SELECT client.id                                         AS client_id,
       client.name                                       AS client_name,
       TIMESTAMPDIFF(MINUTE, log.startdate, log.enddate) AS minutes

# "INNER JOIN" - active clients / users only
FROM client,
     user,
     log

WHERE client.active = 1
  AND client.id = user.client_id
  AND user.id = log.user_id
  AND log.startdate BETWEEN '2022-06-01 00:00:00' AND '2022-06-01 23:59:59'
  AND log.enddate BETWEEN '2022-06-01 00:00:00' AND '2022-06-01 23:59:59'
  # Idiot-proof
  AND log.startdate <= log.enddate

GROUP BY client.id,
         client.name
