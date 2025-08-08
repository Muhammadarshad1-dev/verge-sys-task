<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

class DropboxService {
    private $dropbox;

    public function __construct($accessToken = null) {
        $app = new DropboxApp(DROPBOX_APP_KEY, DROPBOX_APP_SECRET, $accessToken);
        $this->dropbox = new Dropbox($app);
    }

    public function getAuthUrl() {
        return $this->dropbox->getAuthHelper()->getAuthUrl(DROPBOX_REDIRECT_URI);
    }

    public function getFixedAuthUrl() {
        return str_replace('https://dropbox.com', 'https://www.dropbox.com', $this->getAuthUrl());
    }

    public function authenticate($code) {
        $accessToken = $this->dropbox->getAuthHelper()->getAccessToken($code, null, DROPBOX_REDIRECT_URI);
        $_SESSION['dropbox_access_token'] = $accessToken->getToken();
    }

    public function uploadFile($filePath, $fileName) {
        $uploadedFile = $this->dropbox->upload($filePath, "/" . $fileName, ['autorename' => true]);

        $sharedLink = $this->dropbox->postToAPI("/sharing/create_shared_link_with_settings", [
            "path" => $uploadedFile->getPathDisplay(),
            "settings" => ["requested_visibility" => "public"]
        ]);

        $data = $sharedLink->getDecodedBody();
        return str_replace('?dl=0', '?raw=1', $data['url']);
    }
}
?>
