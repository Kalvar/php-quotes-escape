<?php
/*
  Copyright (c) 2013 Kuo-Ming Lin (http://kalvar-kaki.blogspot.tw/)

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.
*/
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
    /*
     * @ Why double use str_replace() to unescapes &lt; and &gt;
     *   - Because of the htmlspecialchars() will be escaping the < and > symbols actually, 
     *     But it won't be really decode from using htmlspecialchars_decode(),
     *     When it displays on browser that it'll be fine, 
     *     But it'll be damaged when we need to catch the source code likes use json_encode() to response some web-service requests.
     */
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

  /*
   * @ 去除反斜線( Unescape Slashes )
   */
  public function unescapeSlashesWithString($_stirng = '')
  {
    if( !$_stirng ) return '';
    return stripslashes( $_string );
  }

}
?>