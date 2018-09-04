<?php
/**
 * User: xczizz
 * Date: 2018/9/2
 * Time: 23:15
 */

namespace common\service;

use common\service\models\UserTag;
use common\service\models\Tag;

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
            return false;
        }
    }

    public static function updateTag($id, $target, $name, $info = null)
    {
        $tag = Tag::findOne($id);
        if ($tag) {
            if (!empty($name)) {
                $tag->name = $name;
            }
            if (!empty($target)) {
                $tag->target = $target;
            }
            if (!empty($info)) {
                $tag->info = $info;
            }
            $tag->uid = substr(sha1($tag->target . $tag->name), 0, 8);
            if ($tag->save()) {
                return $tag;
            }
        }
        return false;
    }

    public static function getTags()
    {
        $tags = Tag::find()->asArray()->all();
        return $tags;
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
        if (UserTag::findOne(['user_id' => $user_id, 'tag_id' => $tag_id])) {
            return false;
        }
        $user_tag = new UserTag();
        $user_tag->user_id = $user_id;
        $user_tag->tag_id = $tag_id;
        $user_tag->created_at = time();
        if ($user_tag->save()) {
            $tag = Tag::findOne($tag_id);
            return ['id' => $user_tag->id, 'name' => $tag->name, 'info' => $tag->info, 'uid' => $tag->uid];
        } else {
            return false;
        }
    }

    public static function getUserTags($user_id)
    {
        $tagsModel = UserTag::find()->where(['user_id' => $user_id])->all();
        $result = [];
        foreach ($tagsModel as $model) {
            $result[] = [
                'id' => $model->id,
                'name' => $model->tag->name,
                'info' => $model->tag->info,
                'uid' => $model->tag->uid
            ];
        }
        return $result;
    }

    public static function deleteUserTag($id, $user_id)
    {
        $user_tag = UserTag::findOne(['id' => $id, 'user_id' => $user_id]);
        return $user_tag && $user_tag->delete();
    }
}