<?php
/*
 * @ Author  : Kuo-Ming Lin
 * @ Email   : ilovekalvar@gmail.com 
 * @ Version : V1.0
 * @ 功能說明 : 
 *   - 針對 $_POST, $_GET, Array, String 等，使用魔術跳脫符號進行簡易消毒。
 */
class Quotes
{
  public function __construct(){


  }

  private function _executeEscape($_requests = '')
  {
    //if( !$_requests ) return '';
    if( gettype($_requests) === 'array' )
    {
      $_results = array();
      foreach($_requests as $_key => $_value):
        //是陣列
        if( gettype($_value) === 'array' )
        {
          //跑遞迴處理
          $_results[$_key] = $this->escapeHtmlString($_value);
        }
        else
        {
          $_results[$_key] = htmlspecialchars($_value, ENT_QUOTES); 
        } 
      endforeach; 
      return $_results;
    }
    else
    {
      return htmlspecialchars($_requests, ENT_QUOTES);  
    }   
  }

  /*
   * @ 執行 HTML 跳脫字元
   */
  public function escapeHtmlString($_htmlString = '')
  { 
    if( !$_htmlString ) return '';
    return $this->_executeEscape($_htmlString); 
  }

  /*
   * @ 執行 HTML 跳脫字元反解譯
   */
  public function unescapeHtmlString($_htmlString = '')
  {
    if( !$_htmlString ) return '';
    $_unescaped = htmlspecialchars_decode($_htmlString, ENT_QUOTES);
    $_unescaped = str_replace('&lt;', '<', $_unescaped);
    $_unescaped = str_replace('&gt;', '>', $_unescaped);
    return $_unescaped;
  }

  /*
   * @ 執行 HTML + 資料庫反解譯
   *   - 將從 MySQL 撈出來的資料反解回 HTML 碼後，還要再一次反解 \ 字元。
   */
  public function unescapeHtmlStringFromMysql($_htmlString = '')
  {
    if( !$_htmlString ) return '';
    return stripslashes( $this->unescapeHtmlString( $_htmlString ) );
  }

}
?>