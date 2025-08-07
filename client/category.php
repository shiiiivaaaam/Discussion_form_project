<select name="category" id="category" class="form-control">
    <option value="">Select A Categroy</option>

    <?php
        @include("./common/db.php");
        $query = "select * from category";
        $result = $conn->query($query);
        if ($result){
            foreach( $result as $row ){
            $id = $row["id"];
            $name =ucfirst( $row["name"] );
            echo "<option value=$id>$name</option>";
        }   
    }    
        ?>
</select>