<?php

// Copyright [2025] [Wendy]

// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at

//     http://www.apache.org/licenses/LICENSE-2.0

// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

namespace App\Config;

class AuthMiddleware implements Middleware {
    function before(): void {

        if ($_SESSION['ingat_saya'] == 1) {
            $waktu_sesi = 86400;
        } else {
            $waktu_sesi = 3600;
        }

        if (isset($_SESSION['LAST_ACTIVITY'])) {
            if (time() - $_SESSION['LAST_ACTIVITY'] > $waktu_sesi) {
                session_unset();
                session_destroy();
                header('Location: ' . BASEURL . "/autentikasi");
                exit();
            }
        }

        $_SESSION['LAST_ACTIVITY'] = time();

        if(!isset($_SESSION['id_admin'])) {
            header('Location: ' . BASEURL . "/autentikasi");
            exit();
        }
    }
}