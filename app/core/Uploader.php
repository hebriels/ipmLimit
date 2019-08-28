<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 16.05.2018
 * Time: 16:26
 */

namespace app\core;

use SplFileInfo;
class Uploader
{
    public $errMessage;
    protected $userFile;

    public $uploadsDir;
    public $fileName;
    protected $fileType;
    protected $allowedFileType = ['jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG', 'pdf', 'bmp', 'doc', 'docx', 'xls', 'xlsx'];


    public function __construct($userFile)
    {
        $this->userFile =  $userFile;
        $this->userFile['name'] = $this->translit($userFile['name']);
        $this->fileType = new SplFileInfo($userFile['name']);
    }
    //Функция транслита
    public function translit($str,$code='utf-8')
    {
        $str = mb_strtolower($str, $code);
        $str = str_replace(array(
            '?','!',',',':',';','*','(',')','{','}','%','#','№','@','$','^','+','/','\\','=','|','"','\'',
            'а','б','в','г','д','е','ё','з','и','й','к',
            'л','м','н','о','п','р','с','т','у','ф','х',
            'ъ','ы','э',' ','ж','ц','ч','ш','щ','ь','ю','я'
        ), array(
            '','','','','','','','','','','','','','','','','','','','','','','',/*remove bad chars*/
            'a','b','v','g','d','e','e','z','i','y','k',
            'l','m','n','o','p','r','s','t','u','f','h',
            'j','i','e','_','zh','ts','ch','sh','shch',
            '','yu','ya'
        ), $str);

        return date("dmY_His").'_'.$str;
    }

}
