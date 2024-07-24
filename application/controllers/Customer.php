<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 고객센터 Controller
 */
class Customer extends MTMbiz_Controller
{
    private $base_url = '/customer';

    function __construct()
    {
        parent::__construct();
        $this->sanitize_post_data();
        $this->sanitize_get_data();
    }

    /**
     * Author : 배진환
     * Usage : 고객센터 index
     */
    public function index()
    {
        try {
            $page_info = $this->getPageInfoUser($this->base_url);
            $data = [
                'page_info' => $page_info,
                'business_list' => $this->business_list
            ];
            $this->load->view('/users/include/_1_head', $data);
            $this->load->view('/users/include/_2_nav', $data);
            $this->load->view('/users/customer/v_customer', $data);
            $this->load->view('/users/include/_3_modal');
            $this->load->view('/users/include/_4_footer');
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 공지사항 목록
     */
    public function noticeList()
    {
        $result = [];
        try {
            $page_info['curr_page'] = ($this->input->post('curr_page')) ? html_escape($this->input->post('curr_page')) : 1;
            $page_info['sch_keyword'] = '';
            $page_info['sch_category'] = array();
            $page_info['sch_status'] = array();
            $page_info['sort_key'] = "regdate";
            $page_info['sort_direction'] = "desc";
            $page_info['page_scale'] = 5;
            $page_info['calculate'] = false;

            $this->load->model('Notice_model');
            $result = $this->Notice_model->get_notice_list($page_info);
            $total_page = ($result[1] == 0) ? 0 : (($result[1] % $page_info['page_scale'] == 0) ? ($result[1] / $page_info['page_scale']) : (int)($result[1] / $page_info['page_scale']) + 1);

            $list_html = "";

            foreach ($result[0] as $list) {
                $regdate = replaceDate2($list->regdate);
                $list_html .= <<<LIST
                        <tr class="cursor_hand get_notice_info" data-idx="{$list->idx}">
                            <td class="ta_center">{$list->idx}</td>
                            <td>{$list->title}</td>
                            <td></td>
                            <td class='ta_center'>{$regdate}</td>
                        </tr>
                LIST;
            }

            $data = [
                'dataList' => $list_html,
                'totalRecord' => $result[1],
                'totalPage' => $total_page == 0 ? 1 : $total_page
            ];

            $result = array("flag" => true, "message" => "data load success.", "data" => $data);
        } catch (Exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 공지사항 상세
     */
    public function noticeView()
    {
        try {
            $idx = $this->input->post("idx");
            $this->load->model('Notice_model');
            $result = $this->Notice_model->get_notice_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $result = array("flag" => true, "message" => "data load success.", "data" => $result);
        } catch (Exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : QnA 목록
     */
    public function qnaList()
    {
        $result = [];
        try {
            $page_info['curr_page'] = ($this->input->post('curr_page')) ? html_escape($this->input->post('curr_page')) : 1;
            $page_info['sch_keyword'] = ($this->input->post('sch_keyword')) ? html_escape($this->input->post('sch_keyword')) : '';

            $page_info['sch_category'] = array();
            $page_info['sch_status'] = array();
            $page_info['sort_key'] = "regdate";
            $page_info['sort_direction'] = "desc";
            $page_info['page_scale'] = 4;
            $page_info['calculate'] = false;

            $this->load->model('Qna_model');
            $result = $this->Qna_model->get_qna_list($page_info);
            $total_page = ($result[1] == 0) ? 0 : (($result[1] % $page_info['page_scale'] == 0) ? ($result[1] / $page_info['page_scale']) : (int)($result[1] / $page_info['page_scale']) + 1);

            $list_mo = "";
            $list_pc = "";

            foreach ($result[0] as $list) {
                $regdate = replaceDate2($list->regdate);
                $row_span = ($list->status > 0) ? "2" : "";

                $list_mo .= <<<LIST_MO
                    <tr class='quest_list'>
                        <td rowspan='{$row_span}' class="ta_center">{$list->row_num}</td>
                        <td class="cursor_hand get_qna_info" data-idx="{$list->idx}">{$list->subject}</td>
                        <td>{$list->name}</td>
                        <td>{$regdate}</td>
                    </tr>
                LIST_MO;
                if ($list->status > 0) {
                    $list_mo .= <<<LIST_MO
                        <tr class='answer_list'>
                            <td class="cursor_hand get_qna_info" data-idx="{$list->idx}" colspan='3'>↳ 문의하신 내용에 답변드립니다.</td>
                        </tr>
                    LIST_MO;
                }

                $list_pc .= <<<LIST_PC
                    <tr>
                        <td class="ta_center" rowspan="{$row_span}">{$list->row_num}</td>
                        <td class="cursor_hand get_qna_info" data-idx="{$list->idx}">{$list->subject}</td>
                        <td class="ta_center">{$list->name}</td>
                        <td class="ta_center">{$regdate}</td>
                    </tr>
                LIST_PC;
                if ($list->status > 0) {
                    $list_pc .= <<<LIST_PC
                        <tr>
                            <td class="cursor_hand get_qna_info" data-idx="{$list->idx}" colspan='3'>↳ 문의하신 내용에 답변드립니다.</td>
                        </tr>';                  
                    LIST_PC;
                }
            }

            $data = [
                'dataList_pc' => $list_pc,
                'dataList_mo' => $list_mo,
                'totalRecord' => $result[1],
                'totalPage' => $total_page
            ];

            $result = array("flag" => true, "message" => "data load success.", "data" => $data);
        } catch (Exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : QnA 등록
     */
    public function qnaSave()
    {
        $result = [];
        try {
            $requestData = $this->input->post();

            $model_method = "";
            if ($requestData['mode'] == 'mod') {
                $model_method = 'update';
            } else if ($requestData['mode'] == 'add') {
                $model_method = 'create';
            } else {
                throw new Exception('어떤 저장이 필요한지 확인할 수 없습니다.');
            }

            $valid_config = array(
                array('field' => 'name', 'label' => '작성자', 'rules' => 'required', 'errors' => array('required' => '작성자명은 필수 입력입니다.')),
                array('field' => 'subject', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목은 필수 입력입니다.')),
                array('field' => 'qna_pass', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
                array('field' => 'contents', 'label' => '내용', 'rules' => 'required', 'errors' => array('required' => '내용은 필수 입력입니다.')),
                array('field' => 'tel', 'label' => '연락처', 'rules' => 'required', 'errors' => array('required' => '연락처는 필수 입력입니다.')),
                array('field' => 'email', 'label' => '이메일주소', 'rules' => 'required|valid_email', 'errors' => array('required' => '내용은 필수 입력입니다.','valid_email'=>'올바른 이메일주소를 입력해 주십시오.'))
            );

            $this->form_validation->set_rules($valid_config);
            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

            $this->load->model('Qna_model');

            if ($model_method == 'update') {
                $qnaInfo = $this->Qna_model->get_qna_info($requestData['idx']);
                if ($qnaInfo->status != '0') throw new Exception("처리가 완료되어 수정할 수 없습니다.");
            }


            $idx = $this->Qna_model->{$model_method}($requestData);

            $result = array("flag" => true, "message" => "저장되었습니다.", "idx" => $idx);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : QnA 비밀번호 확인
     * Description : QnA 상세와 삭제 시 확인용
     */    
    public function qnaConfirm()
    {
        $result = [];
        try {
            $idx = $this->input->post("idx");
            $password = $this->input->post("password");

            $valid_config = array(
                array('field' => 'password', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
            );
            $this->form_validation->set_rules($valid_config);

            $this->load->model('Qna_model');
            $result = $this->Qna_model->get_qna_info($idx);

            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());
            if (is_null($result)) throw new Exception("대상을 확인할 수 없습니다.");
            if (!password_verify($password, $result->qna_pass)) throw new Exception("비밀번호가 일치하지 않습니다.");
            if ($result->is_del == 'Y') throw new Exception("이미 삭제되었습니다.");

            $result = array("flag" => true, "message" => "확인되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : QnA 상세
     */    
    public function qnaView()
    {
        try {
            $idx = $this->input->post("idx");
            $this->load->model('Qna_model');
            $result = $this->Qna_model->get_qna_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $result = array("flag" => true, "message" => "data load success.", "data" => $result);
        } catch (Exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : QnA 삭제
     */    
    public function qnaDelete()
    {
        $result = [];
        try {
            $idx = $this->input->post("idx");
            $password = $this->input->post("password");

            $valid_config = array(
                array('field' => 'password', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
            );
            $this->form_validation->set_rules($valid_config);

            $this->load->model('Qna_model');
            $result = $this->Qna_model->get_qna_info($idx);

            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());
            if (is_null($result)) throw new Exception("대상을 확인할 수 없습니다.");
            if (!password_verify($password, $result->qna_pass)) throw new Exception("비밀번호가 일치하지 않습니다.");
            if ($result->is_del == 'Y') throw new Exception("이미 삭제되었습니다.");
            if ($result->status != '0') throw new Exception("처리가 완료되어 삭제할 수 없습니다.");

            $this->Qna_model->delete_update($idx);

            $result = array("flag" => true, "message" => "삭제되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }
}
