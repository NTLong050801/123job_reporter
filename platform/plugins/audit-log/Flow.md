# Mô tả quá trình diễn ra
1. Khởi tọa event `CreatedEvent`, `UpdatedEvent`, `DeletedEvent`  cùng với một mảng `listener` trong `EventServiceProvider`
2. Ghi log bằng cách gọi event sử dụng tương ứng: `event(CreatedEvent)` `event(UpdatedEvent)` `event(DeletedEvent)`
3. Trong listener của các event hành động. Gọi tới event xử lý chung. Tại từng listener xử lý riêng từng vấn đề.
4. Event xử lý chung sẽ gọi tới 1 listener đã được khởi tạo ở bước 1. Tại đây sẽ ghi dữ liệu


# Flow
                                EventServiceProvider
                                       ||
                                       ||
               -----------------------------------------------------------------------------
               | (1)                   | (2)                   | (3)                      | (4)
         AuditHandlerEvent    CreatedContentEvent      UpdatedContentEvent        DeletedContentEvent
               |                        |                      |                          |
               | (1.1)                  | (2.1)                | (3.1)                    | (4.1)
        AuditHandlerListener  CreateContentListener    UpdatedContentListener    DeletedContentListener
                                        |                      |                           |
                                        | (2.2)                | (3.2))                    | (4.2)
                             event(AuditHandlerEvent)  event(AuditHandlerEvent)     event(AuditHandlerEvent)



