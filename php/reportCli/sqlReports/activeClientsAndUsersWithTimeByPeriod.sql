SELECT client.id                                         AS client_id,
       client.name                                       AS client_name,
       user.id                                           AS user_id,
       user.name                                         AS user_name,
       TIMESTAMPDIFF(MINUTE, log.startdate, log.enddate) AS minutes

# "INNER JOIN" - active clients / users only
FROM client,
     user,
     log

WHERE client.active = 1
  AND client.id = user.client_id
  AND user.id = log.user_id
  AND log.startdate BETWEEN '${STARTDATE_FROM}' AND '${STARTDATE_TO}'
  AND log.enddate BETWEEN '${ENDDATE_FROM}' AND '${ENDDATE_TO}'
  # Idiot-proof
  AND log.startdate <= log.enddate

GROUP BY client.id,
         client.name,
         user.id,
         user.name
