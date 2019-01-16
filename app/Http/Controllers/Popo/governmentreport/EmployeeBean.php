<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 1/7/19
 * Time: 10:56 AM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class EmployeeBean
{
    private $name;
    private $icNo;

    public function __construct(array $array = [])
    {
        $this->name = isset($array['name']) ? $array['name'] : null;
        $this->icNo = isset($array['icNo']) ? $array['icNo'] : null;
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'icNo' => $this->icNo
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
