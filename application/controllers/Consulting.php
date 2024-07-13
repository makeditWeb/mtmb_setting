<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 견적요청 Controller
 */
class Consulting extends MTMbiz_Controller
{
    private $base_url = '/consulting';

    function __construct()
    {
        parent::__construct();
        $this->sanitize_post_data();
        $this->sanitize_get_data();
    }

    /**
     * Author : 배진환
     * Usage : 견적요청 index
     */
    public function index()
    {
        try {
            $page_info = $this->getPageInfoUser($this->base_url);

            $this->load->model('Portfolio_model');
            $portfolio_list = $this->Portfolio_model->get_portfolio_list($page_info);

            $this->load->model('Partbanner_model');
            $partbanner_list = $this->Partbanner_model->get_partbanner_list($page_info);

            $data = [
                'page_info' => $page_info,
                'business_list' => $this->business_list,
                'portfolio_list' => $portfolio_list,
                'partbanner_list' => $partbanner_list
            ];
            $this->load->view('/users/include/_1_head', $data);
            $this->load->view('/users/include/_2_nav', $data);
            $this->load->view('/users/consulting/v_consulting', $data);
            $this->load->view('/users/include/_3_modal');
            $this->load->view('/users/include/_4_footer');
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 견적요청 질문 목록
     * Description : 선택된 의뢰분야의 사전 질문과 답변 목록을 반환
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


    // public function raw_json_encode($input) {

    //     return preg_replace_callback(
    //         '/\\\\u([0-9a-zA-Z]{4})/',
    //         function ($matches) {
    //             return mb_convert_encoding(pack('H*',$matches[1]),'UTF-8','UTF-16');
    //         },
    //         json_encode($input)
    //     );

    // }    

    /**
     * Author : 배진환
     * Usage : 견적요청 등록
     * Description : 견적요청을 저장 = 컨설팅 등록
     */
    public function save()
    {
        $result = [];
        $param_work = [];
        $question_value = [];
        try {
            $requestData = $this->input->post();

            $valid_config = array(
                array('field' => 'consulting_pass', 'label' => '상담 비밀번호', 'rules' => 'required', 'errors' => array('required' => '상담 비밀번호는 필수 입력입니다.')),
                array('field' => 'name', 'label' => '기업명', 'rules' => 'required', 'errors' => array('required' => '기업명은 필수 입력입니다.')),
                array('field' => 'tel1', 'label' => '기업 전화번호 맨 앞자리', 'rules' => 'required', 'errors' => array('required' => '기업 전화번호 맨 앞자리는 필수 입력입니다.')),
                array('field' => 'tel2', 'label' => '기업 전화번호 가운데 자리', 'rules' => 'required', 'errors' => array('required' => '기업 전화번호 가운데 자리는 필수 입력입니다.')),
                array('field' => 'tel3', 'label' => '기업 전화번호 마지막 자리', 'rules' => 'required', 'errors' => array('required' => '기업 전화번호 마지막 자리는 필수 입력입니다.')),
                array('field' => 'employee_name', 'label' => '담당자명', 'rules' => 'required', 'errors' => array('required' => '담당자명은 필수 입력입니다.')),
                array('field' => 'employee_tel1', 'label' => '담당자 연락처 맨 앞자리', 'rules' => 'required', 'errors' => array('required' => '담당자 연락처 맨 앞자리는 필수 입력입니다.')),
                array('field' => 'employee_tel2', 'label' => '담당자 연락처 가운데 자리', 'rules' => 'required', 'errors' => array('required' => '담당자 연락처 가운데 자리는 필수 입력입니다.')),
                array('field' => 'employee_tel3', 'label' => '담당자 연락처 마지막 자리', 'rules' => 'required', 'errors' => array('required' => '담당자 연락처 마지막 자리는 필수 입력입니다.')),
                array('field' => 'employee_email', 'label' => '담당자 이메일주소', 'rules' => 'required', 'errors' => array('required' => '담당자 이메일주소는 필수 입력입니다.')),
                array('field' => 'request', 'label' => '세부사항', 'rules' => 'required', 'errors' => array('required' => '세부사항은 필수 입력입니다.'))
            );

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

            $requestData['tel'] = $requestData['tel1'] . "-" . $requestData['tel2'] . "-" . $requestData['tel3'];
            $requestData['employee_tel'] = $requestData['employee_tel1'] . "-" . $requestData['employee_tel2'] . "-" . $requestData['employee_tel3'];
            $requestData['request'] = str_replace('\r', '', $requestData['request']);
            $requestData['reg_path'] = '0';
            $requestData['file_count'] = 0;

            $this->load->model('Consulting_model');
            $consulting_idx = $this->Consulting_model->consulting_create($requestData);

            // 파일 저장 처리
            $file_info = array();
            $file_result_1 = $this->fileUpload_doc("consulting_file1", '/uploads/consulting/' . $consulting_idx . '/', '', true);
            $file_result_2 = $this->fileUpload_doc("consulting_file2", '/uploads/consulting/' . $consulting_idx . '/', '', true);
            $file_result_3 = $this->fileUpload_doc("consulting_file3", '/uploads/consulting/' . $consulting_idx . '/', '', true);

            if ($file_result_1['flag']) {
                array_push($file_info, array(
                    'file_name' => $file_result_1['client_name'],
                    'file_path' => $file_result_1['file_virtual_path'],
                    'file_size' => $file_result_1['file_size'],
                    'file_type' => $file_result_1['file_type'],
                    'file_ext' => $file_result_1['file_ext'],
                    'is_image' => $file_result_1['is_image'],
                ));
                $requestData['file_count']++;
            }
            if ($file_result_2['flag']) {
                array_push($file_info, array(
                    'file_name' => $file_result_2['client_name'],
                    'file_path' => $file_result_2['file_virtual_path'],
                    'file_size' => $file_result_2['file_size'],
                    'file_type' => $file_result_2['file_type'],
                    'file_ext' => $file_result_2['file_ext'],
                    'is_image' => $file_result_2['is_image'],
                ));
                $requestData['file_count']++;
            }
            if ($file_result_3['flag']) {
                array_push($file_info, array(
                    'file_name' => $file_result_3['client_name'],
                    'file_path' => $file_result_3['file_virtual_path'],
                    'file_size' => $file_result_3['file_size'],
                    'file_type' => $file_result_3['file_type'],
                    'file_ext' => $file_result_3['file_ext'],
                    'is_image' => $file_result_3['is_image'],
                ));
                $requestData['file_count']++;
            }

            $file_param = array();
            $file_param['idx'] = $consulting_idx;
            $file_param['column'] = 'file_info';
            $file_param['value'] = json_encode($file_info);

            $this->Consulting_model->update_single_column($file_param);

            $category_list = array_values(array_unique(array_column($requestData['question_values'], 'segment')));
            foreach ($category_list as $category) {
                $param_work = [];
                $question_value = array_values(array_map(function ($item) {
                    unset($item['segment']);
                    return $item;
                }, array_filter($requestData['question_values'], function ($item) use ($category) {
                    return $item['segment'] == $category;
                })));

                $question_value = json_encode($question_value);

                $param_work['category'] = $category;
                $param_work['consulting_idx'] = $consulting_idx;
                $param_work['question_value'] = $question_value;
                $this->Consulting_model->consulting_add_work($param_work);
            }

            $_POST["idx"] = $consulting_idx; // session 로깅을 할때 식별값을 넣기 위함.
            $_POST["tel"] = $requestData['tel'];
            $_POST["employee_tel"] = $requestData['employee_tel'];

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
            $this->sessionsLogging($result, "/");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 견적요청 목록
     * Description : 의뢰목록 = 견적요청 목록 = 컨설팅 목록 다 같은말이며 관리자에서 직접 등록한 요청건은 보이지 않음.
     */
    public function consultingList()
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
            $page_info['is_user'] = true;
            $page_info['calculate'] = false;

            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_list($page_info);
            $total_page = ($result[1] == 0) ? 0 : (($result[1] % $page_info['page_scale'] == 0) ? ($result[1] / $page_info['page_scale']) : (int)($result[1] / $page_info['page_scale']) + 1);

            $list_mo = "";
            $list_pc = "";

            foreach ($result[0] as $list) {
                $regdate = replaceDate2($list->regdate);
                $status_txt = ($list->status > 0) ? "답변완료" : "접수확인";
                $row_span = ($list->status > 0) ? "2" : "";


                $list_mo .= <<<LIST_MO
                    <tr class='question'>
                        <td rowspan='{$row_span}' class="ta_center">{$list->row_num}</td>
                        <td class="cursor_hand get_consulting_info" data-idx="{$list->idx}">
                          <span>'{$list->name}'님의<br>디자인 견적요청이 접수되었습니다.</span>
                        </td>
                        <td class="ta_center">
                           <span>{$list->employee_name}</span>
                           <span>{$regdate}</span>
                        </td>
                    </tr>
                LIST_MO;
                if ($list->status > 0) {
                    $list_mo .= <<<LIST_MO
                        <tr class='answer'>
                            <td class="cursor_hand get_consulting_info" data-idx="{$list->idx}">↳ 상담이 완료되었습니다.</td>
                            <td><b>답변완료</b></td>
                        </tr>
                    LIST_MO;
                }

                $list_pc .= <<<LIST_PC
                    <tr>
                        <td class="ta_center" rowspan="{$row_span}">{$list->row_num}</td>
                        <td data-idx="{$list->idx}">'{$list->name}'님의 디자인 견적요청이 접수되었습니다.</td>
                        <td>{$regdate}</td>
                        <td>{$status_txt}</td>
                    </tr>
                LIST_PC;
                if ($list->status > 0) {
                    $list_pc .= <<<LIST_PC
                        <tr class="answer_qna">
                            <td class="cursor_hand get_consulting_info" data-idx="{$list->idx}">↳ 상담이 완료되었습니다.</td>
                            <td><b>MTM Biz Design</b></td>                            
                            <td>답변완료</td>
                        </tr>
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
     * Usage : 견적요청 비밀번호 확인
     * Description : 의뢰목록에서 볼때 사용됨
     */
    public function consultingConfirm()
    {
        $result = [];
        try {
            $idx = $this->input->post("idx");
            $password = $this->input->post("password");

            $valid_config = array(
                array('field' => 'password', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
            );
            $this->form_validation->set_rules($valid_config);

            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_info($idx);

            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());
            if (is_null($result)) throw new Exception("대상을 확인할 수 없습니다.");
            if (!password_verify($password, $result->consulting_pass)) throw new Exception("비밀번호가 일치하지 않습니다.");
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
     * Usage : 견적요청 상세
     */
    public function consultingView()
    {
        try {
            $idx = $this->input->post("idx");
            $page_info = [];
            $page_info['idx'] = $idx;
            $page_info['partner'] = false;

            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');
            $result2 = $this->Consulting_model->get_consulting_work_list($page_info);

            $data = [
                'consulting_info' => $result,
                'consulting_work_list' => $result2,
                'business_list' => $this->business_list
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
     * Usage : 만족도 목록
     */
    public function reviewList()
    {
        $result = [];
        try {
            $page_info['curr_page'] = ($this->input->post('curr_page')) ? html_escape($this->input->post('curr_page')) : 1;
            $page_info['sch_keyword'] = ($this->input->post('sch_keyword')) ? html_escape($this->input->post('sch_keyword')) : '';

            $page_info['sch_category'] = array();
            $page_info['sch_status'] = array();
            $page_info['sort_key'] = "regdate";
            $page_info['sort_direction'] = "desc";
            $page_info['page_scale'] = 7;
            $page_info['calculate'] = false;

            $this->load->model('Review_model');
            $result = $this->Review_model->get_review_list($page_info);
            $total_page = ($result[1] == 0) ? 0 : (($result[1] % $page_info['page_scale'] == 0) ? ($result[1] / $page_info['page_scale']) : (int)($result[1] / $page_info['page_scale']) + 1);

            $list_mo = "";
            $list_pc = "";

            foreach ($result[0] as $list) {
                $regdate = replaceDate2($list->regdate);

                $score_html = "<ul class=\"star\">";
                $score_html .= "<li class=\"on\">★</li>";
                $score_html .= ($list->score) > 1 ? "<li class=\"on\">★</li>" : "<li>☆</li>";
                $score_html .= ($list->score) > 2 ? "<li class=\"on\">★</li>" : "<li>☆</li>";
                $score_html .= ($list->score) > 3 ? "<li class=\"on\">★</li>" : "<li>☆</li>";
                $score_html .= ($list->score) > 4 ? "<li class=\"on\">★</li>" : "<li>☆</li>";
                $score_html .= "</ul>";

                $list_mo .= <<<LIST_MO
                    <tr>
                        <td class="ta_center">{$list->row_num}</td>
                        <td class="cursor_hand get_review_info" data-idx="{$list->idx}">
                                {$list->subject}
                        </td>
                        <td class="ta_center">
                            <span>{$list->name}</span>
                            <span>{$regdate}</span>
                        </td>
                    </tr>
                LIST_MO;

                $list_pc .= <<<LIST_PC
                    <tr>
                        <td>{$list->row_num}</td>
                        <td class="cursor_hand get_review_info" data-idx="{$list->idx}">{$list->subject}</td>
                        <td class="ta_center">{$list->name}</td>
                        <td class="ta_center">{$regdate}</td>
                        <td class="ta_center">{$list->read_count}</td>
                    </tr>
                LIST_PC;
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
     * Usage : 만족도 저장
     */
    public function reviewSave()
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
                array('field' => 'score', 'label' => '만족도', 'rules' => 'required', 'errors' => array('required' => '만족도는 필수 입력입니다.')),
                array('field' => 'subject', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목은 필수 입력입니다.')),
                array('field' => 'review_pass', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
                array('field' => 'contents', 'label' => '내용', 'rules' => 'required', 'errors' => array('required' => '내용은 필수 입력입니다.'))
            );

            $this->form_validation->set_rules($valid_config);
            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

            $this->load->model('Review_model');
            $idx = $this->Review_model->{$model_method}($requestData);

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
     * Usage : 만족도 비밀번호 확인
     * Description : 만족도의 수정, 삭제 시 사용됨
     */
    public function reviewConfirm()
    {
        $result = [];
        try {
            $idx = $this->input->post("idx");
            $password = $this->input->post("password");

            $valid_config = array(
                array('field' => 'password', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
            );
            $this->form_validation->set_rules($valid_config);

            $this->load->model('Review_model');
            $result = $this->Review_model->get_review_info($idx);

            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());
            if (is_null($result)) throw new Exception("대상을 확인할 수 없습니다.");
            if (!password_verify($password, $result->review_pass)) throw new Exception("비밀번호가 일치하지 않습니다.");
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
     * Usage : 만족도 삭제
     */
    public function reviewDelete()
    {
        $result = [];
        try {
            $idx = $this->input->post("idx");
            $password = $this->input->post("password");

            $valid_config = array(
                array('field' => 'password', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
            );
            $this->form_validation->set_rules($valid_config);

            $this->load->model('Review_model');
            $result = $this->Review_model->get_review_info($idx);

            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());
            if (is_null($result)) throw new Exception("대상을 확인할 수 없습니다.");
            if (!password_verify($password, $result->review_pass)) throw new Exception("비밀번호가 일치하지 않습니다.");
            if ($result->is_del == 'Y') throw new Exception("이미 삭제되었습니다.");

            $this->Review_model->delete_update($idx);

            $result = array("flag" => true, "message" => "삭제되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 만족도 상세
     */
    public function reviewView()
    {
        try {
            $idx = $this->input->post("idx");
            $this->load->model('Review_model');
            $result = $this->Review_model->get_review_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $this->Review_model->read_count_update($idx);

            $result = array("flag" => true, "message" => "data load success.", "data" => $result);
        } catch (Exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 포트폴리오 상세
     */
    public function portfolioView()
    {
        try {
            $idx = $this->input->post("idx");
            $this->load->model('Portfolio_model');
            $result = $this->Portfolio_model->get_portfolio_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $result = array("flag" => true, "message" => "data load success.", "data" => $result);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }
}
