<?php
// タイムゾーンを日本に設定
date_default_timezone_set('Asia/Tokyo');

// 取得したいRSSのURLを設定
$url = "https://note.com/wofa/m/m05a52142832e/rss";
// MAXの表示件数を設定
$max = 3;

// simplexml_load_file()でRSSをパースしてオブジェクトを取得、オブジェクトが空でなければブロック内を処理
if( $rss = simplexml_load_file( $url ) ){
$cnt = 0;
$output = '';
/*
* $item->title：タイトル
* $item->link：リンク
* strtotime( $item->pubDate )：更新日時のUNIX TIMESTAMP
* $item->description：詳細
*/
// item毎に処理
foreach( $rss->channel->item as $item ){
// MAXの表示件数を超えたら終了
if( $cnt >= $max ) break;

// 日付の表記の設定
$date = date( 'Y.m.d', strtotime( $item->pubDate ) );
// 出力するHTML
$output .= '<li class="itemlists_topics_list">';
$output .= '<a href="'. $item->link .'" class="itemlists_topics_link" target="_blank">';
$output .= '<span class="itemlists_topics_thumb">';
$output .= '<img src="'. $item->children('media',true)->thumbnail . '" class="" alt="">';
$output .= '</span>';
$output .= '<div class="itemlists_topics_content">';
$output .= '<p class="itemlists_topics_title f__16 f__ltr__min f__ln__28 f__wt__7">'. $item->title .'</p>';
$output .= '<time class="itemlists_topics_date">';
$output .= '<span class="itemlists_topics_the_date font_belfr f__ltr__1">'. $date .'</span>';
$output .= '</time>';
$output .= '</div>';
$output .= '</a>';
$output .= '</li>';
$cnt++;
}
// 文字列を出力
echo $output;
}
?>