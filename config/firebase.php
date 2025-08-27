<?php

declare(strict_types=1);

return [
    /*
     * ------------------------------------------------------------------------
     * Default Firebase project
     * ------------------------------------------------------------------------
     */

    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
     * ------------------------------------------------------------------------
     * Firebase project configurations
     * ------------------------------------------------------------------------
     */

    'projects' => [
        'app' => [

            /*
             * ------------------------------------------------------------------------
             * Credentials / Service Account
             * ------------------------------------------------------------------------
             *
             * In order to access a Firebase project and its related services using a
             * server SDK, requests must be authenticated. For server-to-server
             * communication this is done with a Service Account.
             *
             * If you don't already have generated a Service Account, you can do so by
             * following the instructions from the official documentation pages at
             *
             * https://firebase.google.com/docs/admin/setup#initialize_the_sdk
             *
             * Once you have downloaded the Service Account JSON file, you can use it
             * to configure the package.
             *
             * If you don't provide credentials, the Firebase Admin SDK will try to
             * auto-discover them
             *
             * - by checking the environment variable FIREBASE_CREDENTIALS
             * - by checking the environment variable GOOGLE_APPLICATION_CREDENTIALS
             * - by trying to find Google's well known file
             * - by checking if the application is running on GCE/GCP
             *
             * If no credentials file can be found, an exception will be thrown the
             * first time you try to access a component of the Firebase Admin SDK.
             *
             */

            'credentials' => [
                "type" => "service_account",
                "project_id" => "rifavinotinto",
                "private_key_id" => "da403ed1b7a32ecc5448f60c2a3582040d217489",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC+cMlu5Of3t2aV\nbezI2nbrD/ulty/8jBe7L2x2U5NP9Qj/A8vcK21H4RdlPy6DECbIQhGijeapGSHm\ncOsEItRoeG/jFFFn4npU4ePteGGim8nAABO3p9nwZja8Y9i8PFpP0el+EiU/rd7i\n0P+elNYlzbV0OZnvp9Eo0h66kKi5mhcU0uvCxdtz/0dxrs5NV7johJAggT6H9P6R\ns9zRE/ApMtyMbPa4PVXa7yyaG2dCk5sjfvUOFNzyXWOWzwOSEuY+egvqfSqk98XM\nu0uIug6PWuAqLVr7q1V5JfFk+ZPoVOFy/+qSqI07+HdEUYRSrzGMR6u+vQ6YP0Ys\n8VnqJZ+7AgMBAAECggEAH3D3kLtyIM/CvAD+CtsmrwBgh6eK4KMwd9MIkTCTLaxC\n4/d4fM0eqbNb7XdU8oaEIKPnzXKoFlrz4dvasUAe2XCo6FC+b+xQThtNSjOJyxL1\naCGbH8MylCIL/2Zsrgc40dzSM+JDDBRkrAXdbg0cnfkscBfidlK6kYa/VAX2FU42\na2s+mFTgILJPm9Q/wJfh/yWQmwX2zG9K2fOnLJTGJAXXoRFGXtH8EvuamiW45zE4\nSjWUhzFsMDosQBCSbBzXDce65x0eBorziF+VncRfqfcx85J3JyQiXbG8Nxk+Kb4p\ny+q4WIsmiNDQwd02PISeyfDWT+0d27hfFw7p5QN2oQKBgQDnoHDp/ekn2WG5PCvi\nmhGfFoOIFJ3j8ZPYhK0Pdu0Dk+6XEgFegANKl+kaU6QnrNOUjx7b/TY8A3bV1r/k\nrKwimACJmQDYcWZUbD0X09bXEZfA2qqmyIumpawUowJAQ5lhqbfa1BWnvE8blSpP\npeoQaV+EhLGEVw4A/qjx+J3I1wKBgQDSet+j/cDFpJbsa11b1Acase586ZFaV2UL\nti7O3GCXApNl9yJDIuynrZhw99AK8ZhKEjOlrpZu7KsDnkDXncbX11ZhsexAs39p\nia6cQFbVGvxJXBZ3ZzFADfX7+BDBQpVezW7zv6BzpelMGZN4lcy3jXrWq6BFbpES\n2JYtXQJPvQKBgQCqcASmKZBHIk4mX4BrXbNZvNdMat9Du59u0zIFDx2YZGJMB5O6\nVbgWS3HbTXCdQS7vQeETP1+JCYOIFl1dhzGiwvaiSVO18Lu7o2nQ/rA30Vo5Lq4j\ny633EjFtfgVKBHP4yUngW+8TXh1Xzosz0IJLUT5X5Mw69VP4p2rpomd4QQKBgQC8\n/OEj4WueyztMitan5kh+urc1547AvGoZSvraeNwtm31396AHAivWHzQacxiVSvp/\nv7oqEQo4DT88n3L/Z0asdUi1rclBCyrjO2HSIJ8W+AUBZbMygTCioCZ3mPSKYtu1\n5OWz7SMH1DgXQXu9sVvAkEN0z2O4FCAk+N5XWwUBTQKBgEwCLiZf+Zk8GCwOCJEB\nms34b8iXjziigmK3pL28QOJXdj/VyEf7xuCYbPXbx1QLt21JpfQhunOK+FhioG5I\n7dWJszx8ZkufI13kNJsrR+BTWVNx0xAITIPgz1FFibqOyOgD1NxpMjKVptD3Ecxt\nXe0aOnN5pNm9ok6jlZa/e/RO\n-----END PRIVATE KEY-----\n",
                "client_email" => "firebase-adminsdk-fbsvc@rifavinotinto.iam.gserviceaccount.com",
                "client_id" => "113321998299129802392",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40rifavinotinto.iam.gserviceaccount.com",
                "universe_domain" => "googleapis.com"
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Auth Component
             * ------------------------------------------------------------------------
             */

            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firestore Component
             * ------------------------------------------------------------------------
             */

            'firestore' => [

                /*
                 * If you want to access a Firestore database other than the default database,
                 * enter its name here.
                 *
                 * By default, the Firestore client will connect to the `(default)` database.
                 *
                 * https://firebase.google.com/docs/firestore/manage-databases
                 */

                // 'database' => env('FIREBASE_FIRESTORE_DATABASE'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Realtime Database
             * ------------------------------------------------------------------------
             */

            'database' => [

                /*
                 * In most of the cases the project ID defined in the credentials file
                 * determines the URL of your project's Realtime Database. If the
                 * connection to the Realtime Database fails, you can override
                 * its URL with the value you see at
                 *
                 * https://console.firebase.google.com/u/1/project/_/database
                 *
                 * Please make sure that you use a full URL like, for example,
                 * https://my-project-id.firebaseio.com
                 */

                'url' => env('FIREBASE_DATABASE_URL'),

                /*
                 * As a best practice, a service should have access to only the resources it needs.
                 * To get more fine-grained control over the resources a Firebase app instance can access,
                 * use a unique identifier in your Security Rules to represent your service.
                 *
                 * https://firebase.google.com/docs/database/admin/start#authenticate-with-limited-privileges
                 */

                // 'auth_variable_override' => [
                //     'uid' => 'my-service-worker'
                // ],

            ],

            'dynamic_links' => [

                /*
                 * Dynamic links can be built with any URL prefix registered on
                 *
                 * https://console.firebase.google.com/u/1/project/_/durablelinks/links/
                 *
                 * You can define one of those domains as the default for new Dynamic
                 * Links created within your project.
                 *
                 * The value must be a valid domain, for example,
                 * https://example.page.link
                 */

                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Cloud Storage
             * ------------------------------------------------------------------------
             */

            'storage' => [

                /*
                 * Your project's default storage bucket usually uses the project ID
                 * as its name. If you have multiple storage buckets and want to
                 * use another one as the default for your application, you can
                 * override it here.
                 */

                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),

            ],

            /*
             * ------------------------------------------------------------------------
             * Caching
             * ------------------------------------------------------------------------
             *
             * The Firebase Admin SDK can cache some data returned from the Firebase
             * API, for example Google's public keys used to verify ID tokens.
             *
             */

            'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

            /*
             * ------------------------------------------------------------------------
             * Logging
             * ------------------------------------------------------------------------
             *
             * Enable logging of HTTP interaction for insights and/or debugging.
             *
             * Log channels are defined in config/logging.php
             *
             * Successful HTTP messages are logged with the log level 'info'.
             * Failed HTTP messages are logged with the log level 'notice'.
             *
             * Note: Using the same channel for simple and debug logs will result in
             * two entries per request and response.
             */

            'logging' => [
                'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL'),
                'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL'),
            ],

            /*
             * ------------------------------------------------------------------------
             * HTTP Client Options
             * ------------------------------------------------------------------------
             *
             * Behavior of the HTTP Client performing the API requests
             */

            'http_client_options' => [

                /*
                 * Use a proxy that all API requests should be passed through.
                 * (default: none)
                 */

                'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY'),

                /*
                 * Set the maximum amount of seconds (float) that can pass before
                 * a request is considered timed out
                 *
                 * The default time out can be reviewed at
                 * https://github.com/kreait/firebase-php/blob/6.x/src/Firebase/Http/HttpClientOptions.php
                 */

                'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT'),

                'guzzle_middlewares' => [
                    // MyInvokableMiddleware::class,
                    // [MyMiddleware::class, 'static_method'],
                ],
            ],
        ],
    ],
];
