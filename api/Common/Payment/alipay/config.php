<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016082600313075",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAqwOps4c1oM6eABL5cd2TVdYo00ZDwrC6XpqEL0rSVOjhphUkgP7uZF6b2bhi97MgN2HfOqPjC/5COo8yv3BLr1AS0nO8AHxY1eudPi1j6DgmdlzA1npOEZyOizm2L+3RXxxJDKixrLYzjH+G0GKYNztS2oXSRqKHkLF7CG6y09/ZvdtMoCpqfBcS4Q5J9xj3RTRFqiW5SftrtTAtj4B6wkLhK0B9NuOusdXch5A2u9PCCE7/pC8L4p/Uvqd5W/Aa8qPTgIDCoEnxAYDT94KKveo1yZUndR2mBL80EHwMcido3AYVpQNE5rH67rn47Cl5G87wp1BNSoFe+zH6Zxh3awIDAQABAoIBACpMg6MGJHub33TBPLWvSowGpp5rWMNFFzPjICLabN/XokiEHj1R0QE+bWoSs1f1FFjeemp0sun6f8MgPDshuXapZZ5sReoQ16BB4OjKLVX43XqVQpVKNxkgEhnZsnh0aD8QLflVmGzRvDpaKKxOVrwCjmHCi9owxTtCyt2xE8ZXxhjbLlevyPsa5B+mQpaRIkuxeUYQncKJU14e17IpYT5qiQq3b9tIo7veVkedbJlo9H1X+S/7O1YBWc/3+DltigWRj5Zi/UVBv+/Z8QEhPyaSZDiAlZMLMI2jI5QKiDHTM/Y+aJj+wVtQEX30h/eCwrnEuw7//bjmdDmefzOW91ECgYEA4uZXfkQM8K5aa0mPz7PlZCNE5PRaexae7mOr4K9N7xFnO9LiAxMDOqcXTB/8q3Ky6RdYqXJ3hiJXUUp0ZhDsLbj9ScdQKG/tUeugkuM+K1QR5qzQQ7Z+28bPDUgn5l7rENIeU+N0+Gwc/ms6kQkby6cAQeUWxg8Ve21vxW9pJ0cCgYEAwPJ3+WWm5LznZuVw3EpoRveNEZB2L6czFSB2FvmjaOsi+W/8xjfUuBGpFWlhor2PLU0fCry/1xh9lHUmiGveMNUGolxh+ctNyfwarHv9XTynRqIkRsVV/e8rOolQYucu/JN0PFEnSwZbTHS/NapYmDDgKv0NRAEUkabLYqOByL0CgYEAzjeA714T0K71uKqbzK74XgF7/QZkMZiGi60EqmlJUG0lwQZRqW+fMLBqCSLNNllBZ31zdFV3ce5GI7iif50Dui517Zb7MDVBoIGhZ76mYyS+PEN16QS02TQgPDcHJGXCCICfVajVR26jD0wPZ3+6xmWaY0k9YHaXFJ2KxwsRq8MCgYEAhK/6G5NxU0opZFSS6Ztt3Kfu5k5PSHQWKAg7zY79dnCFi74cuf+5FKBog+YFk9ICPWgU2eB1mSkpa0epKRXtJe3JcyxO4GaUZzws58MYuN62NlfY1KZufYPVWZsGog1T/bQ1siko+Wo0rP54ZCJybK7n6gg98C9CAuwOYBYLcY0CgYBxbODhVcrcMzsCjrcDV0v2JjjPUzmS8g1EKsH+JoIDtAaepD58KOOuOcSvUqeEILdu88ScMY1tiAlH28JGtXfr/glZZVcRZnfmJaEn/rcsDkdK1O8nA/bOKmQ6ySidpCu3qI+yWyMQD6U9xu+A4Xo8JNrrO9IBe/YZK7D70jik9g==",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqwOps4c1oM6eABL5cd2TVdYo00ZDwrC6XpqEL0rSVOjhphUkgP7uZF6b2bhi97MgN2HfOqPjC/5COo8yv3BLr1AS0nO8AHxY1eudPi1j6DgmdlzA1npOEZyOizm2L+3RXxxJDKixrLYzjH+G0GKYNztS2oXSRqKHkLF7CG6y09/ZvdtMoCpqfBcS4Q5J9xj3RTRFqiW5SftrtTAtj4B6wkLhK0B9NuOusdXch5A2u9PCCE7/pC8L4p/Uvqd5W/Aa8qPTgIDCoEnxAYDT94KKveo1yZUndR2mBL80EHwMcido3AYVpQNE5rH67rn47Cl5G87wp1BNSoFe+zH6Zxh3awIDAQAB",
		
	
);