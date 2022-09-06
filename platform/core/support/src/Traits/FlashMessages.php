<?php
/**
 * Source https://stackoverflow.com/questions/21004310/in-laravel-the-best-way-to-pass-different-types-of-flash-messages-in-the-sessio
 */
namespace Workable\Support\Traits;

trait FlashMessages
{
    protected static function message($level = 'info', $message = null)
    {

        if (session()->has('messages')) {
            $messages = session()->pull('messages');
        }

        $messages[] = $message = ['level' => $level, 'message' => $message];

        session()->flash('messages', $messages);

        return $message;
    }

    protected static function messages()
    {
        return self::hasMessages() ? session()->pull('messages') : [];
    }

    protected static function hasMessages()
    {
        return session()->has('messages');
    }

    protected static function success($message)
    {
        return self::message('success', $message);
    }

    protected static function info($message)
    {
        return self::message('info', $message);
    }

    protected static function warning($message)
    {
        return self::message('warning', $message);
    }

    protected static function danger($message)
    {
        return self::message('danger', $message);
    }
}
