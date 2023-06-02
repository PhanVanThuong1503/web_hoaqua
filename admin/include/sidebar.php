<div class="main">
<div class="sidebar">
    <div class="dashboard">
        <a href="index.php">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </div>
    <ul class="menu-sidebar">
        <li>
            <a href="categories.php">
                <p>Danh mục sản phẩm</p>
            </a>
        </li>
        <li>
            <a href="#" class="menu-item2">
                <p>Sản phẩm</p>
                <i class="fas fa-angle-right rote2"></i>
            </a>
            <ul class="menu-item-child2">
                <li><a href="productadd.php">Thêm mới</a></li>
                <li><a href="products.php">Danh sách</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item3">
                <p>Tin tức</p>
                <i class="fas fa-angle-right rote3"></i>
            </a>
            <ul class="menu-item-child3">
                <li><a href="newsadd.php">Thêm mới</a></li>
                <li><a href="news.php">Danh sách</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item4">
                <p>Đơn hàng</p>
                <i class="fas fa-angle-right rote4"></i>
            </a>
            <ul class="menu-item-child4">
                <li><a href="orders.php">Danh sách đơn hàng</a></li>    
                <li><a href="sales.php">Thống kê doanh thu</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item5">
                <p>Nhà cung cấp</p>
                <i class="fas fa-angle-right rote5"></i>
            </a>
            <ul class="menu-item-child5">
                <li><a href="nccadd.php">Thêm nhà cung cấp</a></li>    
                <li><a href="ncc.php">Danh sách nhà cung cấp</a></li>
            </ul>
        </li>
        <li>
            <a href="users.php">
                <p>Khách hàng</p>
            </a>
        </li>
        <li>
            <a href="feedback.php">
                <p>Phản hồi</p>
            </a>
        </li>
    </ul>
</div>


</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
$('.menu-item1').click(function() {
    $('.menu-item-child1').toggleClass("show");
    $('.rote1').toggleClass("rotate");
});
$('.menu-item2').click(function() {
    $('.menu-item-child2').toggleClass("show");
    $('.rote2').toggleClass("rotate");
});
$('.menu-item3').click(function() {
    $('.menu-item-child3').toggleClass("show");
    $('.rote3').toggleClass("rotate");
});
$('.menu-item4').click(function() {
    $('.menu-item-child4').toggleClass("show");
    $('.rote4').toggleClass("rotate");
}); 
$('.menu-item5').click(function() {
    $('.menu-item-child5').toggleClass("show");
    $('.rote5').toggleClass("rotate");
}); 
</script>