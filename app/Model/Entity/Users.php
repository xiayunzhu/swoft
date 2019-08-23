<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Users
 *
 * @since 2.0
 *
 * @Entity(table="users")
 */
class Users extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 
     *
     * @Column()
     *
     * @var int
     */
    private $age;

    /**
     * 
     *
     * @Column(hidden=true)
     *
     * @var string
     */
    private $password;

    /**
     * 
     *
     * @Column(name="user_desc", prop="userDesc")
     *
     * @var string
     */
    private $userDesc;

    /**
     * 
     *
     * @Column()
     *
     * @var string
     */
    private $name;


    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $age
     *
     * @return void
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @param string $password
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $userDesc
     *
     * @return void
     */
    public function setUserDesc(string $userDesc): void
    {
        $this->userDesc = $userDesc;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUserDesc(): ?string
    {
        return $this->userDesc;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

}
