<?php
  
  namespace App\Basic;

  class Config{
    
  // data base configuration
  protected const DB_HOST = '',
                  DB_PORT = '',
                  DB_NAME = '',
                  DB_USER = '',
                  DB_PASSWORD = '',
                  DB_PREFIX = '';
  // send mail confirmation
  protected const MAIL_HOST = 'stmp.gmail.com',
                  MAIL_NAME = '',
                  MAIL_ADDRESS = '',
                  MAIL_PASSWORD = '',
                  MAIL_PORT = 0,
                  MAIL_SMTP_AUTH = true,
                  MAIL_SMTP_SECURE = 'tls';
    
    
  }