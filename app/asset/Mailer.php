<?php

namespace App\Asset;

class Mailer
{
    /**
     * @var string
     */
    private static $recipient = CONTACT_EMAIL;

    /**
     * @param array $request
     * @return array
     */
    public static function send(array $request): array
    {
        if (!empty($request['fullname']) && !empty($request['email']) && !empty($request['message']))
        {
            if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL))
            {
                return [
                    'error' => 'The entered email address is invalid.'
                ];
            }
            else
            {
                $message = '<html>
                                <body>
                                    ' . nl2br(htmlspecialchars($request['message'])) . '
                                </body>
                            </html>';
        
                $headers = array(
                    'From'         => '"' . $request['fullname'] . '" <' . $request['email'] . '>',
                    'Reply-To'     => $request['email'],
                    'MIME-Version' => '1.0',
                    'Content-Type' => 'text/html; charset=utf-8'
                );
        
                if (@mail(self::$recipient, SITE_NAME, $message, $headers))
                {
                    return [
                        'success' => 'Your message has been sent.'
                    ];
                }
                else
                {
                    return [
                        'error' => 'Your message could not be sent.'
                    ];
                }
            }
        }
        else
        {
            return [
                'error' => 'Please complete all fields correctly.'
            ];
        }
    }
}