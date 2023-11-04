<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- 引入jquery庫 -->
</head>

<body>
    <?php
    // echo $apple;
    // echo "<br/>";
    // echo $banana;
    // echo $model_data;
    ?>
    <form action="<?php echo base_url() ?>main/form_validation" method="POST">
        <?php
        if ($this->uri->segment(2) == "inserted") { //檢查第二個參數有沒有"inserted"
            //base url - http://localhost/ci/main
            //redirect url - http://localhost/ci/main/inserted  
            //main - segment(1)  
            //inserted - segment(2)  
            echo '<p class="text-success">Data Inserted</p>'; //有的話，列印以下訊息
        }
        //更新資料的部分
        if ($this->uri->segment(2) == "updated") {
            echo '<p class="text-success">Data Updated</p>';
        }
        ?>
        <?php  
           if(isset($user_data))  
           {  
                foreach($user_data->result() as $row)  
                {  
           ?>
        <div class="form-group">
            <label>Enter First Name</label>
            <input type="text" name="first_name" value="<?php echo $row->first_name; ?>" class="form-control" />
            <span class="text-danger"><?php echo form_error("first_name"); ?></span>
        </div>
        <div class="form-group">
            <label>Enter Last Name</label>
            <input type="text" name="last_name" value="<?php echo $row->last_name; ?>" class="form-control" />
            <span class="text-danger"><?php echo form_error("last_name"); ?></span>
        </div>
        <div class="form-group">
            <input type="hidden" name="hidden_id" value="<?php echo $row->id; ?>" />
            <input type="submit" name="update" value="Update" class="btn btn-info" />
        </div>
        <?php       
                }  
           }  
           else  
           {  
           ?>

        first_name:<input type="text" name="first_name">
        <span class="text-danger"><?php echo form_error("first_name"); ?></span>
        last_name:<input type="text" name="last_name">
        <span class="text-danger"><?php echo form_error("last_name"); ?></span>
        send:<input type="submit" name="insert">

        <?php  
           }  
           ?>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($fetch_data->num_rows() > 0) {
            foreach ($fetch_data->result() as $row) {
        ?>
        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->first_name; ?></td>
            <td><?php echo $row->last_name; ?></td>
            <td><a href="#" class="delete_data" id="<?php echo $row->id; ?>">Delete</a></td>
            <td><a href="<?php echo base_url(); ?>main/update_data/<?php echo $row->id; ?>">Edit</a></td>
        </tr>
        <?php
            }
        } else {
            ?>
        <tr>
            <td colspan="5">No Data Found</td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
<script>
$(document).ready(function() {
    $('.delete_data').click(function() {
        var id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this?")) {
            window.location = "<?php echo base_url(); ?>main/delete_data/" + id;
        } else {
            return false;
        }
    });
});
</script>

</html>
<!-- 您在程式碼中加入了 $autoload['helper'] = array('url'); 這行程式碼，
然後在表單中使用了 &lt;?php echo base_url()?&gt; 來產生表單的 action 屬性。 這是一個常見的用法，讓我解釋一下它的原理：
$autoload['helper'] = array('url');：透過在自動載入的說明文件中包含'url'，您啟用了CodeIgniter 的URL 幫助函數庫，其中包含了一些有用的函數，包括base_url( )。
<form action="&lt;?php echo base_url()?&gt;main/form_validation">：在表單中，您使用 base_url() 函數來產生表單的 action 屬性。 base_url() 函數傳回基本 URL，通常是應用程式的根URL。 在這裡，您將其用於建立表單的 action 屬性。

base_url() 函數將傳回您的 CodeIgniter 應用程式的根URL。 
例如，如果您的應用程式在 http://localhost/ci/ 中執行，
那麼 base_url() 將會傳回 http://localhost/ci/。
所以，<form action="&lt;?php echo base_url()?&gt;main/form_validation"> 
最終產生的表單 action 屬性將是 http://localhost/ci/main/form_validation。
這樣做的好處是，無論您將應用程式部署到什麼樣的環境中（例如開發環境、生產環境），base_url() 將自動適應應用程式的根URL，而無需手動更改表單 action 屬性。 這提高了應用程式的可移植性和可維護性。

總而言之，使用 base_url() 函數來建立表單的 action 屬性是一種良好的做法，它有助於確保您的應用程式在不同環境中都能正常運作。 -->