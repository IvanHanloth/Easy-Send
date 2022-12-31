<?php
if($if_gray=="on"){
    echo '<style>
    body{
  -webkit-filter: grayscale(100%);
  -moz-filter: grayscale(100%);
  -ms-filter: grayscale(100%);
  -o-filter: grayscale(100%);
  filter: grayscale(100%);
  filter: gray;}
  </style>';
};
echo $footer;
?>
<script src="/public/template/public/js/clipboard.js"></script>