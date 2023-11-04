<?php
class Main_model extends CI_Model //文件名_model，此為model的命名規則
{
    public function test_main()
    {
        // echo "test model";
        $name = "wang";
        return $name; //假設取得了資料庫的資料，將值返回
    }
    public function insert_data($data)
    {
        $this->db->insert("name", $data);
    }
    public function fetch_data()
    {
        $query = $this->db->get("name");
        return $query;
    }
    function delete_data($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("name");
        //DELETE * FROM table_name WHERE id = $id  
    }
    function update_data($data, $id)
    {
        $this->db->where("id", $id);
        $this->db->update("name", $data);
        //UPDATE table_name SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'  
    }
    function fetch_single_data($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get("name");
        return $query;
        //Select * FROM tbl_user where id = '$id'  
    }
}
