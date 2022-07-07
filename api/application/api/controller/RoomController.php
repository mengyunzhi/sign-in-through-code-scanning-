<?php
namespace app\api\controller;     //命名空间，也说明了文件所在的文件夹
use app\common\model\Teacher;
use app\common\model\User;
use app\common\model\Schedule;
use app\common\model\Room;
use app\index\service\MenuService;
use think\Controller;
use think\Request;


class RoomController extends Controller
{
    /*
    * index页面
    */
    public function page() {
        $data['content'] = Room::all();
        return json_encode($data);
    }

    /*
    * 删除教室
    */
    public function delete() {
        $id = Request()->param('id/d');
        $room = Room::get($id);
        $status = $room->delete();
        if ($status) {
            return json_encode($room);
        } else {
            return $room->getError();
        }
    }

    /*
    * 新增教室
    */
    public function add() {
        $json_raw = file_get_contents("php://input");
        $data = json_decode($json_raw);
        $msg = '';
        $room = new Room();
        $room->setAttr('name', $data->name);
        $room->capacity = $data->capacity;
        $status = $room->validate(true)->save();
        if ($status) {
            return $json_raw;
        } else {
            $this->error('添加失败:'.$msg);
        }
    }

    /*
    * 通过id获取教室
    */
    public function getById() {
        $id = Request()->param('id/d');
        return json(Room::get($id));
    }

    /*
    * 更新教室
    */
    public function update() {
            $id = Request()->param('id/d');
            $postData = json_decode(file_get_contents("php://input"));
            $room = room::get($id);
            if (!is_null($postData)) {
                // 写入要更新的数据
                $room->setAttr('name', $postData->name);
                $room->capacity = $postData->capacity;
            }
            $status = $room->validate(true)->save();
            if ($status) {
                return json_encode($status);
            } else {
                $this->error('添加失败:'.$msg);
                return $msg;
            }
        }
}