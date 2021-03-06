# 統一發票紀錄

## 頁面功能與介紹：
1. 首頁(index.php)
   - 可填入發票的資訊，按下儲存按鈕即可存入資料庫
   - 新增完成後會顯示成功與否的提示訊息，可以選擇繼續輸入下一張發票或是導至該期的發票列表
   - 有重置資料表的功能，可以將資料重置為開發完成時當下的資料內容
2. 發票列表(list.php)
   - 會優先顯示當期的發票列表
   - 可以使用左側的下拉選項與按鈕來選擇想顯示發票列表
   - 左側下拉選項會顯示最近的五年
   - 左側的按鈕，除了可以顯示各個期別的發票，也可以選擇當年度所有的發票
   - 右上角有記錄選擇之期別發票的總筆數
   - 該期若沒有任何資料，會顯示"尚無資料"的提示文字
   - 可以針對各個發票做編輯或是刪除
   - 刪除發票時會有彈出視窗做再一次的確認
   - 編輯與刪除完成後，皆有成功與否的提示訊息
3. 對獎(award.php)
   - 會優先顯示當期的獎號
   - 可以使用左側的下拉選項與按鈕來選擇想顯示的獎號
   - 左側下拉選項會顯示最近的五年
   - 右上角有[對獎說明]按鈕，點擊後會顯示有關對獎的說明內容
   - 該期若沒有任何資料，會顯示"尚無資料"的提示文字
   - 若該期的獎號已經過"兌換"的時間，則會顯示提示文字
   - 點擊[全部對獎]按鈕，會將該期別的發票做對獎，並且導至中獎獎號列表的頁面
4. 新增獎號(invoice.php)
   - 可填入各獎項的號碼，按下[儲存]按鈕即可存入資料庫
   - 點擊[重置]按鈕，可以將填入的資料重置成初始狀態
   - 新增完成後會顯示成功與否的提示訊息，可以選擇繼續輸入其他期別獎號或是導至該期的獎號列表
   - 在輸入獎號時，會強制要求各個獎項都至少輸入一個，否則會無法送出
   - 若該期的獎號已經新增過，則會顯示新增失敗的提示訊息，可以選擇重新輸入或是導至該期的獎號列表
   - 該期有資料所以無法再進行新增，只可利用獎號列表的編輯或刪除功能處理
5. 獎號列表(query.php)
   - 會優先顯示當期的獎號
   - 可以使用左側的下拉選項與按鈕來選擇想顯示的獎號
   - 左側下拉選項會顯示最近的五年
   - 可以針對各個獎號做編輯，但是獎項無法做更改
   - 點擊[全部刪除]按鈕，會將該期的獎號全部刪除(刪除後才可以在從新增獎號頁對該期做新增)
   - 編輯與刪除完成後，皆有成功與否的提示訊息
6. 中獎獎號列表(award_list.php)
   - 當沒有中獎時，會顯示提示訊息
   - 當中獎時，會逐一顯示中獎獎號的各項資料與所得獎金，下方會顯示各個獎項的中獎數量、小計與總共數量及總中獎金額
   - 當中獎時，畫面會有煙火的特效
   - 中獎獎號會存入資料庫內，但每次對獎後資料表都會更新
   - 點擊[回對獎頁]按鈕，將會導至對獎頁
7. 生成假資料(dummy.php)
   - 沒有任何一個頁面可以連結至此頁
   - 可以生成發票的假資料以便測試

## 資料庫設計
1. 發票資料表-invoice
   - id      流水號
   - code    英文碼
   - number  發票號碼
   - period  期別
   - expend  花費
   - year    年份
2. 獎號資料表-award_number
   - id      流水號
   - year    年份
   - period  期別
   - number  發票號碼
   - type    獎項
3. 中獎紀錄表-reward_record
   - id      流水號
   - year    年份
   - period  期別
   - code    英文碼
   - number  發票號碼
   - expend  花費
   - reward  獎項
   #### ※每次對獎時，會先將此資料表清空再存入該次的中獎記錄
4. 獎項清單-award_list
   - id      流水號
   - award   獎項
   - bonus   獎金
5. 發票資料表備份-invoice_bak
   - id      流水號
   - code    英文碼
   - number  發票號碼
   - period  期別
   - expend  花費
   - year    年份
6. 獎號資料表備份-award_number_bak
   - id      流水號
   - year    年份
   - period  期別
   - number  發票號碼
   - type    獎項
   #### ※ 5、6用於重置資料表，可使資料重置成開發完後的狀態，以防資料被刪除而無法演示，此兩個db也請匯入

### 測試建議
   - 對獎可以針對2020年5、6月做測試，有特別新增資料讓所有的獎項都顯示

### 開發紀錄
* 2020-05-08
   - 專案開始 
* 2020-05-31
   - 基本需求功能完成
* 2020-06-01
   - 【award】兌獎時間提示
* 2020-06-03
   - 【award】整個table改為foreach生成
   - 【award】獎項、獎金改為從資料庫抓取
   - 【award】對獎按鈕在沒有撈出任何獎號時則不顯示
   - 刪除多餘的form標籤+css修改
   - 【index】跳轉頁更改為同頁提示視窗
   - 【award_list】抓取資料修改
* 2020-06-04
   - 【award_list】中獎時有煙火特效
   - 【award_list】沒獎號資料時，只顯示table的第一列，並顯示提示文字
* 2020-06-05
   - 【award_list】增加小計
   - 【多頁】input的字數限制
* 2020-06-07
   - 【index】增加重置資料功能
* 2020-06-08
   - checkBox顯示時滾動效果取消
   - 部分CSS調整
* 2020-06-09
   -  將資料處理的檔案都整理至api資料夾內，並修改其他頁面的相關路徑
   - 【query】增加刪除與編輯後的提示訊息
   - 【query】修正增開六獎編輯字數的bug
   - 【list】增加刪除與編輯後的提示訊息
   - 【list】修正英文碼儲存後會是小寫的bug
   - 【README】統整內容
* 2020-06-10
   - 整理程式碼，將多餘與不需要的程式碼刪除
   - 將測試的檔案刪除
   - 將資料表的資料備份放入
   - 完成
* 2020-06-15
   - 【invoice】修正新增完成時，噵到獎號列表的期別錯誤
   - 【list】增加分頁功能
   - 部分CSS調整
   - 資料表的資料更新

### 尚未做的功能與調整
* 【All】
  - 登入功能...? -> 暫不考慮，考慮用其他的方法補足
  - 輸入資料的字數限制(maxlength對type="nubmer"的字數限定無效) => 可能要用js、jq -> 6/5 OK
  - 美化
* 【index.php】
  - 輸入發票的跳轉頁美化或更改為同頁顯示提示視窗 -> 6/3 OK
* 【list.php】
  - 刪除功能 -> OK
  - 分頁(10 or 15筆一頁) -> 6/15 OK
  - 刪除後的提示訊息 -> 6/9 OK
  - 編輯後的提示訊息 -> 6/9 OK
* 【invoice.php】
  - 判斷是否資料庫已有輸入的值來防止重複輸入? -> 5/31 OK
* 【query.php】
  - 針對輸入獎號頁做修改(全部刪除) -> 5/31 OK
  - 刪除後的提示訊息 -> 6/9 OK
  - 編輯後的提示訊息 -> 6/9 OK
  - 增開六獎編輯字數的bug -> 6/9 OK
* 【award.php】
  - 全部對獎尚有bug  -> 5/31 OK
  - 小提示的顯示時間  -> 6/1 OK
  - 沒有獎號的項目不可對獎 -> 或是直接不顯示  -> 6/3 OK
  - 最理想狀態: 沒獎號的該列隱藏(在輸入獎號頁以限定每獎項必輸入一筆，可考慮全部的顯示與否即可..?) -> 6/4 OK
* 【award_list.php】
  - 增加圖片或特效美化中獎時的頁面...? -> 6/4 OK
  - 計算各個獎項的小計與修改總計顯示內容 -> 6/5 OK
* 【測試】
  - 對獎除了2020.5 6月外，尚未測試其他月份的中獎顯示狀況 -> 6/3 目前測試正常
* 【其他】
  - 找尋刪除資料表與匯入資料表的方法
  - 【待實驗】刪除資料表: DROP TABLE XXXXX
  - 突然想到可以用拷貝備份的方法取代刪除與匯入，可行性與安全性似乎比較高? 還有待實驗 -> 6/7 測試OK
* 【最後】
  - 完成後要將資料表備份

### MD檔快捷鍵
* ctrl + shift + v : 預覽
* ctrl + k 同時按一下後 在按v - 編輯時預覽
