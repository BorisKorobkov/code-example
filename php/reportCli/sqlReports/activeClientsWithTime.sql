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
  # session can be active (started, but not finished yet). We can't calculate it.
  AND log.startdate IS NOT NULL
  AND log.enddate IS NOT NULL
  # Idiot-proof
  AND log.startdate <= log.enddate

GROUP BY client.id,
         client.name
