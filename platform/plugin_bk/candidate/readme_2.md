###Đặc tả

>Reporter hoạt động dựa vào hồ sơ bên feed_datas, cứ khi nào hồ sơ được index bên feed_datas thì sẽ đủ điều kiện để bắn sang reporter

Dữ liệu được đẩy sang reporter thông qua command:
php72 artisan worker:send-to-report (hiện đang được schedule tự động)

Dữ liệu bắn sang lấy từ bảng feed_datas với nhưng record có trạng thái fd_reporter_status=0, khi bắn xong chuyển = 1

####Các loại thống kê
- Thống kê cv theo tháng
- Thống kê cv theo ngành nghề
- Thống kê cv theo cấp bậc
- Thống kê cv theo bằng cấp

###Các command thống kê

Các command chạy bởi schedule:

```php72 artisan candidate:statistic-candidate --type=cv --today```

```php72 artisan candidate:statistic-candidate --type=career --today```

```php72 artisan candidate:statistic-candidate --type=rank --today```

```php72 candidate:statistic-candidate --type=degree --today```

- Chạy convert tấy cả 4 loại lần lượt: `--type=all`
- Chạy theo ngày hiện tại: `--today`
- Chạy theo ngày cố định: `--date=2021-01-01`
- Chạy theo khoảng (bắt buộc phải có 2 option): `--date_start=2021-01-01 --date_ena=2021-01-31`
- Nếu ko có 4 giá trị `--today`, `--date`, `--date_start`, `--date_end` mặc định sẽ chạy từ đầu đến cuối của cột added_at bảng candidates
