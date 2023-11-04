<?php
defined('BASEPATH') or exit('No direct script access allowed');
// defined('BASEPATH')：這是一個"條件判斷"，檢查常量BASEPATH是否已經被定義。
// 在CodeIgniter中，BASEPATH通常用於指定核心系統文件的目錄路徑。這個條件檢查是否BASEPATH已經定義，如果沒有定義，後面的代碼將繼續執行。
// OR exit('No direct script access allowed');：如果BASEPATH未被定義，這部分代碼使用exit函數停止腳本的執行，並顯示消息“No direct script access allowed”，以防止未經授權的直接訪問。

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will : 也就是，如果開頭沒有用 _ 下底線
	 * map to /index.php/welcome/<method_name> : 那路由就會是 -> 文件名/方法名
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
}


// /** */ 文件註釋：註釋格式通常用於編寫文檔註釋，以提供有關函數、方法、類別等的詳細描述。 這些註解可以被自動產生的文件產生工具（如PHPDoc）解析，並產生程式文件（通常是HTML或其他格式）。 這種註釋風格對於維護程式碼庫和與其他開發人員協作非常有用，因為它提供了更詳細的程式碼說明和規範化的格式。