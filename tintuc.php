<?php
include "include/header.php";
?>

<div class="content">
    <h2 style="text-align:center">TIN TỨC</h2>

    <div class="main">
        <div class="sidebar">
            <div class="danhmuc">
                <p class="ten-tieude">TIN TỨC NỔI BẬT</p>
                <ul>
                    <?php  
                        $get_news = $news->show_news();
                        if($get_news){
                            $i = 0;
                            while($result1 = $get_news->fetch_assoc()){
                                $i++;
                                if($i==7) break;
                    ?>
                    <li class="dm-sp">
                        <a href="">
                            <img src="admin/uploads/<?php echo $result1['news_image'] ?>" alt="">
                            <p><?php echo $result1['news_name'] ?></p>
                        </a>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div class="content-list-tt">
            <?php  
                $get_news2 = $news->show_news();
                if($get_news2){
                    $i = 0;
                    while($result2 = $get_news2->fetch_assoc()){
                        $i++;
                        if($i==7) break;
            ?>
            <li>
                <a href=""><img src="admin/uploads/<?php echo $result2['news_image'] ?>" alt=""></a>
                <a href="" class="ten_tt"><?php echo $result2['news_name'] ?></a>
                <p><?php echo $result2['description'] ?></p>
            </li>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>

<?php
include "include/footer.php";
?>