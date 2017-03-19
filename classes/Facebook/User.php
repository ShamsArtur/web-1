<?php
require_once ('/classes/facebook/facebook.php');
class user
{
    public $id;
    public $name;
    public $birthday;
    public $gender;
    public $groups = array();
    public $picture;
    public $link;
    public $likes = array();
    public $access_token;

    public function __construct($accessToken)
    {
        $url = 'https://graph.facebook.com/me';
        $params = array(
            "fields" => "id,link,birthday,name,gender,groups{id,name,privacy,administrator},likes{access_token,name,id,can_post}",
            "access_token" => $accessToken
        );
        $data = Facebook::cURL('get', $url, $params);

        $this->id       = $data['id'];
        $this->name     = $data['name'];
        $this->birthday = $data['birthday'];
        $this->groups   = $data['groups']['data'];
        $this->likes    = $data['likes']['data'];
        $this->link     = $data['link'];
        $this->access_token = $accessToken;
    }
    public function getUserLink(){
        return $this->link;
    }
    public function getFullName(){
        return $this->name;
    }
	public function getID(){
		return $this->id;
	}
	public function getLikeID(){
	    return $this->likes['id'];
    }
    public function getLikeAccessToken(){
	    return $this->likes['access_token'];
}
    public function getGroups(){
        return $this->groups;
    }
	public function getLikes(){
        return $this->likes;
    }
    public function printPicture(){
        if (!is_bool($this->picture))
            echo '<br><img src="http://graph.facebook.com/'.$this->getID().'/picture?type=large">';
    }

}
?>