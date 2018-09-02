<?php
/**
 * User: xczizz
 * Date: 2018/9/2
 * Time: 23:15
 */

namespace common\service;

use common\models\UserTag;
use common\models\Tag;
use yii\web\ServerErrorHttpException;

class TagService {

    public static function createTag($target, $name, $info = null) {
        $tag = new Tag();
        $tag->target = $target;
        $tag->name = $name;
        $tag->info = $info;
        $tag->uid = substr(sha1($target . $name), 0, 8);
        $tag->created_at = time();
        if ($tag->save()) {
            return $tag;
        } else {
            throw new ServerErrorHttpException();
        }
    }

    public static function updateTag($id, $name = null, $info = null)
    {
        $tag = Tag::findOne($id);
        if ($tag) {
            if (!empty($name)) {
                $tag->name = $name;
            }
            if (!empty($info)) {
                $tag->info = $info;
            }
            $tag->uid = substr(sha1($tag->target . $tag->name), 0, 8);
            if ($tag->save()) {
                return $tag;
            }
        }
        throw new ServerErrorHttpException();
    }
    
    public static function deleteTag($id) {
        $tag = Tag::findOne($id);
        if ($tag && $tag->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function createUserTag($user_id, $tag_id)
    {
        $user_tag = new UserTag();
        $user_tag->user_id = $user_id;
        $user_tag->tag_id = $tag_id;
        $user_tag->created_at = time();
        if ($user_tag->save()) {
            return $user_tag;
        } else {
            throw new ServerErrorHttpException();
        }
    }

    public static function deleteUserTag($id)
    {
        $user_tag = UserTag::findOne($id);
        return $user_tag && $user_tag->delete();
    }
}