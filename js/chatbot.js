$(document).ready(function() {
    $('#chatbot-send').on('click', function() {
        $value = $('#chatbot-input').val().trim();
        $msg = `<div class="user-message" style="margin-top: 8px; display: flex; width: 75%; border: none; justify-content: flex-end; margin-left: auto; border-radius: 12px; align-items: center; padding: 8px;">
                    <p class="user-message" style="font-size: 14px; margin-bottom: 0; margin-right: 2px;background-color: #13547a;padding: 10px;border-radius: 12px;color: white;">${$value}</p>
                    <i class="fas fa-user ms-2" style="background-color: #13547a; color: white; border-radius: 50px; padding: 8px; height: 32px; width: 32px; display: flex; align-items: center; justify-content: center;"></i>
                </div>`
        $('.chat-messages').append($msg);
        $('#chatbot-input').val('');

        $.ajax({
            url: 'message.php',
            type: 'POST',
            data: 'text=' + $value,
            success: function(result) {
                $replay = `<div class="bot-message" style="display: flex; width: 75%; border: none; border-radius: 12px; margin-bottom: 8px; align-items: center; padding: 8px;">
                                <i class="fas fa-robot me-2" style="background-color: #13547a; color: white; border-radius: 50px; padding: 8px; height: 32px; width: 32px; display: flex; align-items: center; justify-content: center;"></i>
                                <p class="chatbot-message" style="font-size: 14px; margin-bottom: 0;background-color: #eee;padding: 10px;border-radius: 12px;">${result}</p>
                            </div>`;
                $('.chat-messages').append($replay);
                $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
            }
        })
    });
});