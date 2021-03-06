<?php
/**
 * YDA Test
 *
 * 1. sidebar check
 * 2. create yda account
 * 3. create county manager account
 * 4. create county contractor account
 * 
 */

class YDA_test extends TestCase
{
  public function setUp() {
    // initialize instance
    $this->resetInstance();
    // login with new yda account
    $this->request(
      'POST',
      ['user', 'login'],
      [
        'id' => 'yda',
        'password' => 'password'
      ]
    );
  }

  public function test_sidebar_check() {
    // check sidebar has yda role's features or not
    $output = $this->request('GET', 'user/index');
    $this->assertContains('建立青年署專員帳號', $output);
    $this->assertContains('建立縣市主管帳號', $output);
    $this->assertContains('建立縣市承辦人帳號', $output);
  }

  public function test_create_yda_account() {
    // create yda account controller test
    $output = $this->request(
      'POST',
      ['user', 'create_yda_account'],
      [
        'id' => 'yda12',
        'password' => '123456789',
        'userName' => 'yda12',
        'phone' => '09xx00xx'
      ]
    );
    $this->assertContains('新增成功', $output);
    // check yda table has new yda row
    $query = $this->CI->db->query("select no from yda where phone = '09xx00xx';");
    $isYdaExist = $query->num_rows();
    $this->assertEquals(1, $isYdaExist);
    // check user table has new user row
    $ydaNo = $query->row(0)->no;
    $query = $this->CI->db->query("select 1 from users where id = 'yda12' and name = 'yda12' and manager = 1 and yda = ?;", array($ydaNo));
    $isUserExist = $query->num_rows();
    $this->assertEquals(1, $isUserExist);
    // clear up fake data
    $this->CI->db->query("delete from users where id = 'yda12' and name = 'yda12' and manager = 1;");
    $this->CI->db->query("delete from yda where no = ?;", array($ydaNo));
  }

  public function test_create_county_manager_account() {
    // create county manager account controller test
    $output = $this->request(
      'POST',
      ['user', 'create_county_manager_account'],
      [
        'id' => 'county11',
        'password' => '123456789',
        'userName' => 'county11',
        'county' => 2
      ]
    );
    $this->assertContains('新增成功', $output);
    // check user table has new user row
    $query = $this->CI->db->query("select 1 from users where id = 'county11' and name = 'county11' and manager = 1 and county = 2;");
    $isUserExist = $query->num_rows();
    $this->assertEquals(1, $isUserExist);
    // clear up fake data
    $this->CI->db->query("delete from users where id = 'county11' and name = 'county11' and manager = 1 and county = 2;");
  }

  public function test_create_county_contractor_account() {
    // create county contractor account controller test
    $output = $this->request(
      'POST',
      ['user', 'create_county_contractor_account'],
      [
        'id' => 'county12',
        'password' => '123456789',
        'userName' => 'county12',
        'county' => 3
      ]
    );
    $this->assertContains('新增成功', $output);
    // check user table has new user row
    $query = $this->CI->db->query("select 1 from users where id = 'county12' and name = 'county12' and manager = 0 and county = 3;");
    $isUserExist = $query->num_rows();
    $this->assertEquals(1, $isUserExist);
    // clear up fake data
    $this->CI->db->query("delete from users where id = 'county12' and name = 'county12' and manager = 0 and county = 3;");
  }

  // public function test_clear_setup_fake_data() {
  //   // clear up fake data generated by setup function
  //   $query = $this->CI->db->query("select no from yda where phone = 'xxxxxxxxxx';");
  //   $ydaNo = $query->row(0)->no;
  //   $this->CI->db->query("delete from users where id = 'yda11' and name = 'yda11' and manager = 1;");
  //   $this->CI->db->query("delete from yda where no = ?;", array($ydaNo));
  //   $query = $this->CI->db->query("select 1 from yda where no = ?;", array($ydaNo));
  //   $isYdaExist = $query->num_rows();
  //   $this->assertEquals(0, $isYdaExist);
  //   $query = $this->CI->db->query("select 1 from users where yda = ?;", array($ydaNo));
  //   $isUserExist = $query->num_rows();
  //   $this->assertEquals(0, $isUserExist);
  // }
}