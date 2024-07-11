<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 컨설팅 Controller
 */
class Consulting extends MTMbiz_Controller
{
    private $base_url = '/admin/consulting';
    private $view_list = '/admin/consulting/v_consulting_list';
    private $view_view = '/admin/consulting/v_consulting_view';
    private $view_form = '/admin/consulting/v_consulting_form';

    function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    public function index()
    {
        $this->list();
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 의뢰 범위별 질문 목록
     * Description : 컨설팅 신청 시 선택된 의뢰범위의 질문 목록과 답변 목록
     */
    public function questionList()
    {
        try {
            $requestData = $this->input->post();
            $this->load->model('Preferences_model');
            $result = $this->Preferences_model->get_questions_list($requestData);
            $result2 = $this->Preferences_model->get_answer_list($requestData);
            $data = [
                'questions' => $result,
                'answers' => $result2
            ];

            $result = array("flag" => true, "message" => "", "data" => $data);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 목록
     */
    public function list()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['calculate'] = false;
            $page_info['is_user'] = false;

            // 통계에서 넘어올때 처리하는 파라미터
            $page_info['sch_customer'] = ($this->input->get('sch_customer')) ? html_escape($this->input->get('sch_customer')) : '';
            $page_info['sch_sdate'] = ($this->input->get('sch_sdate')) ? html_escape($this->input->get('sch_sdate')) : '';
            $page_info['sch_edate'] = ($this->input->get('sch_edate')) ? html_escape($this->input->get('sch_edate')) : '';

            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_list($page_info);
            $paging = $this->paging($page_info['url_full'], $result[1], $page_info['page_scale']);
            $data = [
                'page_info' => $page_info,
                'dataList' => $result[0],
                'paging' => $paging,
                'business_list' => $this->business_list,
                'consulting_status' => $this->consulting_status
            ];

            $this->adminViewLayout($permission_info['data'], $data, $this->view_list);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 상세 view
     * Segment 
     *  - $idx : 식별값
     */
    public function view($idx)
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['idx'] = $idx;
            $page_info['partner'] = false;

            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');
            $result2 = $this->Consulting_model->get_consulting_work_list($page_info);

            $result3 = $this->Admin_model->get_admin_list_nopaging();

            $this->load->model('partner_model');
            $result4 = $this->partner_model->get_partner_list_nopaging();

            $param['controller'] = array('consulting', 'calculate');
            $param['method'] = 'save';
            $param['idx'] = $idx;
            $sessions_log = $this->get_session_log($param);

            $data = [
                'page_info' => $page_info,
                'consulting_info' => $result,
                'consulting_work_list' => $result2,
                'manager_list' => $result3,
                'partner_list' => $result4,
                'business_list' => $this->business_list,
                'consulting_status' => $this->consulting_status,
                'sessions_log' => $sessions_log
            ];

            $this->adminViewLayout($permission_info['data'], $data, $this->view_view);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 등록 view
     * Segment 
     *  - $customer_idx : 고객사 식별값 (고객사 상세에서 등록 시 해당 고객사의 정보들을 자동으로 불러오기 위함.)
     */
    public function add($customer_idx = null)
    {
        try {
            $customer_info = [];
            if ($customer_idx) {
                $this->load->model('Customer_model');
                $customer_info = $this->Customer_model->get_customer_info($customer_idx);
            }

            $permission_info = $this->getAdminNavByPermission('create');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);

            $data = [
                'page_info' => $page_info,
                'business_list' => $this->business_list,
                'customer_info' => $customer_info
            ];

            $this->adminViewLayout($permission_info['data'], $data, '/admin/consulting/v_consulting_add.php');
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 수정 view
     * Segment 
     *  - $idx : 식별값
     */
    public function reply($idx)
    {
        try {
            $permission_info = $this->getAdminNavByPermission('update');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['idx'] = $idx;
            $page_info['partner'] = false;

            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');
            $result2 = $this->Consulting_model->get_consulting_work_list($page_info);

            $result3 = $this->Admin_model->get_admin_list_nopaging();

            $this->load->model('partner_model');
            $result4 = $this->partner_model->get_partner_list_nopaging();

            $param['controller'] = array('consulting', 'calculate');
            $param['method'] = 'save';
            $param['idx'] = $idx;
            $sessions_log = $this->get_session_log($param);

            $data = [
                'page_info' => $page_info,
                'consulting_info' => $result,
                'consulting_work_list' => $result2,
                'manager_list' => $result3,
                'partner_list' => $result4,
                'business_list' => $this->business_list,
                'consulting_status' => $this->consulting_status,
                'sessions_log' => $sessions_log
            ];

            $this->adminViewLayout($permission_info['data'], $data, $this->view_form);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 등록 저장
     */
    public function addSave()
    {
        $result = [];
        $param_work = [];
        $question_value = [];
        $this->sanitize_post_data();
        try {
            $requestData = $this->input->post();

            $valid_config = array(
                array('field' => 'name', 'label' => '기업명', 'rules' => 'required', 'errors' => array('required' => '기업명은 필수 입력입니다.')),
            );

            $requestData['category'] = (isset($requestData['category'])) ? $requestData['category'] : "";

            $this->form_validation->set_rules($valid_config);
            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());


            $question_values = stripslashes($requestData['question_values']);
            $question_values = json_decode(html_entity_decode($question_values), true);
            if (is_null($question_values)) throw new Exception('모든 의뢰범위에 대한 질문의 답을 선택하여 주십시오.');

            foreach ($question_values as $key => $value) {
                $question_values[$key]['question'] = htmlspecialchars($value['question'], ENT_QUOTES, 'UTF-8');
                $question_values[$key]['answer'] = htmlspecialchars($value['answer'], ENT_QUOTES, 'UTF-8');
            }
            $requestData['question_values'] = $question_values;
            if (count($requestData['question_values']) < 1) throw new Exception('최소 1개 이상의 의뢰범위가 있어야 합니다.');

            $requestData['request'] = str_replace('\r', '', $requestData['request']);
            $requestData['file_count'] = 0;

            $this->load->model('Consulting_model');
            $consulting_idx = $this->Consulting_model->consulting_create2($requestData);

            // 삭제 내역 선수 진행 후 등록

            $category_list = array_values(array_unique(array_column($requestData['question_values'], 'segment')));
            foreach ($category_list as $category) {
                $param_work = [];
                $question_value = array_values(array_map(function ($item) {
                    unset($item['segment']);
                    return $item;
                }, array_filter($requestData['question_values'], function ($item) use ($category) {
                    return $item['segment'] == $category;
                })));

                $param_work['category'] = $category;
                $param_work['consulting_idx'] = $consulting_idx;
                $param_work['question_value'] = json_encode($question_value);
                $this->Consulting_model->consulting_add_work($param_work);
            }

            $this->load->model('Preferences_model');
            $mail_result = $this->Preferences_model->get_email_array();
            if (!is_null($mail_result[0]->email_list)) {
                $mail_to = explode('|', $mail_result[0]->email_list);
                $mail_subject = $requestData['name'] . "에서 컨설팅 문의가 왔습니다.";
                $mail_contents = $this->consultingMailContents($requestData);
                $this->sendMail($mail_to, $mail_subject, $mail_contents);
            }

            $smshp_result = $this->Preferences_model->get_smshp_array();
            if (!is_null($smshp_result[0]->smshp_list)) {
                $sms_to = explode('|', $smshp_result[0]->smshp_list);
                $sms_contents = 'https://mtmbds.com/admin/\n' . $requestData['name'] . "에서 컨설팅 문의가 왔습니다.";
                $this->load->helper('sms');
                aligo_sms_send($sms_to, $sms_contents);
            }

            $result = array("flag" => true, "message" => "저장되었습니다.", "idx" => $consulting_idx);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 수정 저장
     */
    public function save()
    {
        $result = [];
        $param_del = [];
        $param_work = [];
        $question_value = [];
        try {
            $requestData = $this->input->post();

            $valid_config = array(
                array('field' => 'name', 'label' => '기업명', 'rules' => 'required', 'errors' => array('required' => '기업명은 필수 입력입니다.')),
                // array('field' => 'tel', 'label' => '기업 대표번호', 'rules' => 'required', 'errors' => array('required' => '기업 대표번호는 필수 입력입니다.')),
                // array('field' => 'employee_name', 'label' => '담당자명', 'rules' => 'required', 'errors' => array('required' => '담당자명은 필수 입력입니다.')),
                // array('field' => 'employee_tel', 'label' => '담당자 연락처', 'rules' => 'required', 'errors' => array('required' => '담당자 연락처는 필수 입력입니다.')),
            );

            $this->form_validation->set_rules($valid_config);
            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

            $this->load->model('Consulting_model');
            $consulting_idx = $this->Consulting_model->consulting_reply($requestData);

            if (isset($requestData['del_category_list'])) {
                $del_param['idx'] = $consulting_idx;
                $del_param['category'] = $requestData['del_category_list'];
                $this->Consulting_model->delete_work_update($del_param);
            }

            if (isset($requestData['question_values'])) {
                $category_list = array_values(array_unique(array_column($requestData['question_values'], 'segment')));
                foreach ($category_list as $category) {
                    $param_work = [];
                    $question_value = array_values(array_map(function ($item) {
                        unset($item['segment']);
                        return $item;
                    }, array_filter($requestData['question_values'], function ($item) use ($category) {
                        return $item['segment'] == $category;
                    })));

                    $param_work['category'] = $category;
                    $param_work['consulting_idx'] = $consulting_idx;
                    $param_work['question_value'] = json_encode($question_value);
                    $this->Consulting_model->consulting_add_work($param_work);
                }
            }

            foreach ($requestData['work_values'] as $work) {
                $param_work = [
                    'consulting_idx' => $consulting_idx,
                    'manager_idx' => $work['manager_idx'],
                    'manager_id' => $work['manager_id'],
                    'manager_name' => $work['manager_name'],
                    'work_range' => $work['work_range'],
                    'mod_count' => $work['mod_count'],
                    'partner_idx' => $work['partner_idx'],
                    'partner_name' => $work['partner_name'],
                    'partner_status' => $work['partner_status'],
                    'status' => $work['status'],
                    'segment' => $work['segment']
                ];
                $this->Consulting_model->consulting_mod_reply_work($param_work);
            }

            $result = array("flag" => true, "message" => "저장되었습니다.", "idx" => $consulting_idx);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 삭제
     */
    public function del()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('delete');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();

            $this->load->model('Consulting_model');
            $this->Consulting_model->delete_update($requestData);

            $result = array("flag" => true, "message" => "삭제되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 목록에서 대상 항목 수정 저장
     */
    public function updateOnList()
    {
        $result = [];

        try {
            $requestData = $this->input->post();

            $valid_config = array(
                array('field' => 'idx', 'label' => '식별값', 'rules' => 'required', 'errors' => array('required' => '대상을 식별할 수 없습니다.')),
                array('field' => 'column', 'label' => '항목', 'rules' => 'required', 'errors' => array('required' => '항목을 확인할 수 없습니다.')),
                array('field' => 'value', 'label' => '값', 'rules' => 'required', 'errors' => array('required' => '값을 확인할 수 없습니다.'))
            );

            $this->form_validation->set_rules($valid_config);
            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

            $this->load->model('Consulting_model');
            $this->Consulting_model->update_single_column($requestData);

            $result = array("flag" => true, "message" => "저장되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }
}
