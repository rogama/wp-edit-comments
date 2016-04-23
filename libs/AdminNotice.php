<?php

/**
 * Class AdminNotice
 */
class AdminNotice
{
    private static $instance;
    const NOTICE_FIELD = 'admin_notice_message';

    /**
     * @return mixed
     */
    static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Display the Admin Notice
     */
    public function displayAdminNotice()
    {
        $option = get_option(self::NOTICE_FIELD);
        $message = isset($option['message']) ? $option['message'] : false;
        $noticeLevel = !empty($option['notice-level']) ? $option['notice-level'] : 'notice-error';

        if ($message) {
            echo "<div class=\"notice {$noticeLevel} is-dismissible\"><p>{$message}</p></div>";
            delete_option(self::NOTICE_FIELD);
        }
    }

    /**
     * @param $message
     */
    public function displayError($message)
    {
        $this->updateOption($message, 'notice-error');
    }

    /**
     * @param $message
     */
    public function displayWarning($message)
    {
        $this->updateOption($message, 'notice-warning');
    }

    /**
     * @param $message
     */
    public function displayInfo($message)
    {
        $this->updateOption($message, 'notice-info');
    }

    /**
     * @param $message
     */
    public function displaySuccess($message)
    {
        $this->updateOption($message, 'notice-success');
    }

    /**
     * @param $message
     * @param $noticeLevel
     */
    protected function updateOption($message, $noticeLevel)
    {
        update_option(self::NOTICE_FIELD, [
            'message' => $message,
            'notice-level' => $noticeLevel
        ]);
    }
}