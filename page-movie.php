<?php

/**
 Template Name: B站追剧页面
 Template author: 老蘑菇，参考 🎉梨花镇的阿肾🎉 追番页
 */

get_header(); ?>

<meta name="referrer" content="never">
<link href="https://cdn.jsdelivr.net/gh/Fog-Forest/bilibili@1.7.2/col.min.css" rel="stylesheet">
<style>
    /* B站追剧 */
    .bangumi-item {
        padding-top: 0;
        padding-bottom: 0;
        border: none
    }

    .bangumi-link {
        padding: 12px;
        border: none
    }

    .bangumi-banner {
        position: relative;
        overflow: hidden
    }

    .bangumi-banner img {
        display: block;
        margin: 20px auto;
        border-radius: 3px;
        width: 100%;
        height: 220px
    }

    @media (max-width:1000px) {

        /*平板适配*/
        .bangumi-banner img {
            height: 265px
        }
    }

    @media (max-width:500px) {

        /*手机适配*/
        .bangumi-banner img {
            height: auto
        }
    }

    .bangumi-des {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.8);
        padding: 6px;
        opacity: 0;
        transition: .3s;
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        overflow: auto
    }

    .bangumi-des p {
        margin: 0
    }

    .bangumi-banner:hover .bangumi-des {
        opacity: 1
    }

    .bangumi-title {
        border: none !important;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Ubuntu', sans-serif
    }

    .bangumi-progress {
        border-radius: 4px;
        height: 8px;
        background: gray
    }

    .page-header {
        text-align: center
    }

    .page-header {
        border-bottom: 1px solid #a773c3
    }

    .page-header h1 small {
        font-size: 18px;
        color: #e42c64
    }

    .page-header h1 {
        color: #63707e;
        font-weight: 800
    }

    .bangumi-item a {
        text-decoration: none;
        color: #000
    }

    /* 收缩展示 */
    .showall {
        width: 100%;
        color: #ffaa00;
        font-size: 20px;
        text-align: center;
        padding: 20px 0;
        transition: all .6s;
    }

    .showall:hover {
        color: #e67474;
    }
</style>

<div class="page-header">
    <h1>我的追剧
        <?php
        require_once("json/bilibiliAcconut.php");
        require_once("json/bilibiliMovie.php");
        $bili = new bilibiliMovie($UID, $Cookie);
        echo "<small>当前已追" . $bili->sum . "部，继续加油！</small></h1></div><div class=\"row\">";
        for ($i = 0; $i < $bili->sum; $i++) {
            if ($i > $show_num) {
                $more = "more";
            }
            echo "<div class=\"bangumi-item col-md-4 col-lg-3 " . $more . "\"><a class=\"no-line bangumi-link\" href=\"https://www.bilibili.com/bangumi/play/ss" . $bili->season_id[$i] . "/ \" target=\"_blank\"><div class=\"bangumi-banner\"><img src=\"" . $bili->image_url[$i] . "\"><div class=\"bangumi-des\"><p>" . $bili->evaluate[$i] . "</p></div></div><div class=\"bangumi-content\"><h3 class=\"bangumi-title\">" . $bili->title[$i] . "</h3><div class=\"bangumi-progress\" style=\"width:100%\"></div><div class=\"bangumi-progress-num\">" . $bili->progress[$i] . "</div></div></a></div>";
        }
        if ($bili->sum > $show_num) {
            echo "<div class=\"showall\">. Show All .</div>";
        }
        ?>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script type="text/javascript">
    // 收缩展示
    $(document).ready(function() {
        $(".more").hide();
        $(".showall").click(function() {
            $(".more").fadeIn();
            $(".showall").text("真的已经到头了哦~");
        });
    });
</script>

<?php
get_footer();
