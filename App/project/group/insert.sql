INSERT INTO payments (clientId, nominal, status, createAt, updateAt)
VALUES (2, 100000, 'SUCCESS', NOW(), NOW());

SET @paymentId = LAST_INSERT_ID();

INSERT INTO subscribes (
  paymentId, premium, jenis, startDate, endDate, lyricDisplay, createPlaylist, downloadLagu, createdAt, updatedAt
)
VALUES (
  @paymentId, true, 'EXPERT', NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH), true, true, false, NOW(), NOW()
);