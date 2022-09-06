# Giới thiệu
Một thư viện wrap lại guzzle. Đưa cho bạn cách dùng đơn giản thông qua cơ chế gọi các hàm

# Các sử dụng

**1. Call a request sync**
```
$formParam = [
            "action" => 1
        ];
$httpBuilder = new HttpBuilder();
$response = $httpBuilder
            ->host("http://mail.123job.abc/")
            ->post("api/v1/mail-sent/store")
            ->formParams($formParam)
            ->call();
```


**2. Call a request async**
```
$formParam = [
            "action" => 1
        ];
$httpBuilder = new HttpBuilder();
$promise = $httpBuildera
            ->host("http://mail.123job.abc/")
            ->post("api/v1/mail-sent/store")
            ->formParams($formParam)
            ->call(true);
            
$response = $promise->then(
            function ($res) {
                return $res->getStatusCode();
                return $res->getBody()->getContents();
            },
            function (RequestException $e) {
                return "4" . $e->getMessage();
            }
        );
echo $response->wait();
```

# Reference
- Trang chủ guzzle: https://docs.guzzlephp.org/en/stable/quickstart.html
- Giới thiệu về async: https://speakerdeck.com/jeremeamia/async-guzzle-concurrent-http-requests-in-php?slide=34
- guzzle-wrapper: https://github.com/sametsahindogan/guzzle-wrapper
- guzzle-wrapper: https://github.com/AndreiArba/bitstone-guzzle-wrapper