<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller //文件名大小寫都可以，但通常就是小寫，main，但class名必須大寫 : Main
{

	public function index()
	{
		// echo "hello Main<br/>";
		// $this->test1();
		//$this->load->model("main_model"); //加載model，此時已載入了這份文件
		//$this->main_model->test_main(); //使用model裡的方法，$this(這個model) -> className(class對大小寫都不敏感，都可以使用) -> 方法

		// $data["apple"] = "apple";
		// $data["banana"] = "banana";
		// $this->load->view("main_view", $data); //view的方法

		//$this->load->model("main_model");
		//$data["model_data"] = $this->main_model->test_main(); //取得資料庫資料
		//$this->load->view("main_view", $data); //view輸出資料

		//抓取資料
		$this->load->model("main_model");
		$data["fetch_data"] = $this->main_model->fetch_data();

		$this->load->view("main_view", $data);
	}

	public function form_validation()
	{
		//echo "ok";
		$this->load->library('form_validation'); //表單驗證庫的物件實例，它允許您存取表單驗證的各種功能。
		// 注意method必需是"POST"，才會起作用

		// set_rules() 方法用於設定欄位的驗證規則。 它接受三個參數：
		// 第一個參數是要驗證的欄位的名稱，這裡是 "first_name"。
		// 第二個參數是字段的可讀名稱，用於在錯誤訊息中標識字段，這裡是 "First Name"。
		// 第三個參數是驗證規則，以字串形式傳遞，這裡包括兩個規則：
		// "required"：要求欄位的值不能為空。
		// "alpha"：要求欄位的值只包含字母字元。
		$this->form_validation->set_rules("first_name", "First Name", 'required|alpha'); //$this去使用加載form_validation的表單驗證
		$this->form_validation->set_rules("last_name", "Last Name", 'required|alpha'); //規則只有POST吃的到值
		// 如果欄位的值不符合這些規則，表單驗證庫將產生錯誤訊息，以便您可以在表單中顯示這些錯誤訊息，指示使用者修正輸入。
		if ($this->form_validation->run()) {
			//表單驗證true
			$this->load->model("main_model");
			$data = array(
				"first_name" => $this->input->post("first_name"), //$this是這個控制器的實例
				"last_name" => $this->input->post("last_name")
			);
			if ($this->input->post("update")) {
				$this->main_model->update_data($data, $this->input->post("hidden_id"));
				redirect(base_url() . "main/updated");
			}
			if ($this->input->post("insert")) {
				$this->main_model->insert_data($data);
				redirect(base_url() . "main/inserted"); //這個網址執行public function inserted()
			}
		} else {
			//表單驗證false
			$this->index(); //就是原地不動，表單頁，並顯示錯誤訊息
		}
	}

	public function inserted()
	{
		$this->index(); //執行這個function內容，也就是$this->load->view("main_view")，跑main_view這個php檔案
	}

	public function delete_data()
	{
		$id = $this->uri->segment(3);
		$this->uri->segment(3);
		// $this->uri 是 CodeIgniter 中的 URI 類別的實例，用於處理和解析 URI。
		// segment(3) 的作用是取得 URI 中的第三個片段，通常是 URL 中路徑部分的第三部分。
		// 在一個典型的 URL 中，例如 http://example.com/controller/method/123，URI 會被分成片段（segments）
		// 第一個片段是 "controller"，表示控制器的名稱。
		// 第二個片段是 "method"，表示控制器中的方法名稱。
		// 第三個片段是 "123"，可能表示一個參數或識別符。
		$this->load->model("main_model");
		$this->main_model->delete_data($id);
		redirect(base_url() . "main/deleted");
	}
	public function deleted()
	{
		$this->index();
	}
	public function update_data()
	{
		$user_id = $this->uri->segment(3);
		$this->load->model("main_model");
		$data["user_data"] = $this->main_model->fetch_single_data($user_id);
		$data["fetch_data"] = $this->main_model->fetch_data();
		$this->load->view("main_view", $data);
	}
	public function updated()
	{
		$this->index();
	}
}
// 完整路徑 :　http://localhost/ci/index.php/main/index