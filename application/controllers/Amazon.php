<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amazon extends CI_Controller {
	
	var $header = array( "User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:40.0) Gecko/20100101 Firefox/40.0" ,
		"Host:www.amazon.cn",
			
			);




	public function index()
	{

		//最近90天
		for($i = 1 ; $i <= 70 ; $i++){
			$url = "http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144174071%2Cp_n_date%3A123706071&page=$i&bbn=144174071&ie=UTF8&qid=1442548006";
			//echo $url;
			$content = $this->temp_amazon($url,'最近90天');
		}
		//当代小说
		for($i = 1 ; $i <= 400 ; $i++){
			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144174071&page=$i&ie=UTF8&qid=1442548216";
			$content = $this->temp_amazon($url,'当代小说');
		}
		//侦探小说
		for($i = 1 ; $i <= 63 ; $i++){
			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144155071&page=$i&ie=UTF8&qid=1442548796";
			$content = $this->temp_amazon($url,'侦探小说');
		}
		//爱情小说
		for($i = 1 ; $i <= 63 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144159071&page=$i&ie=UTF8&qid=1442548847";
			$content = $this->temp_amazon($url,'爱情小说');
		}


		//历史小说
		for($i = 1 ; $i <= 24 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144167071&page=$i&ie=UTF8&qid=1442557356";
			$content = $this->temp_amazon($url,'历史小说');
		}

		//武侠小说
		for($i = 1 ; $i <= 12 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144164071&page=$i&ie=UTF8&qid=1442557475";
			$content = $this->temp_amazon($url,'武侠小说');
		}
		
		//古典小说
		for($i = 1 ; $i <= 89 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144173071&page=$i&ie=UTF8&qid=1442557525";
			$content = $this->temp_amazon($url,'古典小说');
		}

		//魔幻小说
		for($i = 1 ; $i <= 7 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144154071%2Cn%3A144156071&page=$i&bbn=144154071&ie=UTF8&qid=1442557618";
			$content = $this->temp_amazon($url,'魔幻小说');
		}

		//文学名家
		for($i = 1 ; $i <= 99 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144180071%2Cn%3A144201071&page=$i&bbn=144180071&ie=UTF8&qid=1442558687";
			$content = $this->temp_amazon($url,'文学名家');
		}

		//作品集
		for($i = 1 ; $i <= 325 ; $i++){

			$url ="http://www.amazon.cn/s/ref=lp_144206071_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144180071%2Cn%3A144206071&page=$i&ie=UTF8&qid=1442558968";
			$content = $this->temp_amazon($url,'作品集');
		}


		//小说集
		for($i = 1 ; $i <= 41 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144180071%2Cn%3A144206071%2Cn%3A144208071&page=$i&ie=UTF8&qid=1442559046";
			$content = $this->temp_amazon($url,'小说集');
		}
		//历史与社会纪实
		for($i = 1 ; $i <= 32 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144180071%2Cn%3A144228071%2Cn%3A144230071&page=$i&ie=UTF8&qid=1442559112";
			$content = $this->temp_amazon($url,'历史与社会纪实');
		}

		//随笔杂文
		for($i = 1 ; $i <= 224 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A144180071%2Cn%3A144212071%2Cn%3A144214071&page=$i&ie=UTF8&qid=1442559178";
			$content = $this->temp_amazon($url,'随笔杂文');
		}

		//艺术与摄影
		for($i = 1 ; $i <= 281 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143174071&page=$i&bbn=116169071&ie=UTF8&qid=1442559347";
			$content = $this->temp_amazon($url,'艺术与摄影');
		}


		//传记
		for($i = 1 ; $i <= 287 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143175071&page=$i&bbn=116169071&ie=UTF8&qid=1442559403";
			$content = $this->temp_amazon($url,'传记');
		}

		//励志与成功
		for($i = 1 ; $i <= 400 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143192071&page=$i&bbn=116169071&ie=UTF8&qid=1442559472";
			$content = $this->temp_amazon($url,'励志与成功');
		}
		//考试
		for($i = 1 ; $i <= 257 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143193071&page=$i&bbn=116169071&ie=UTF8&qid=1442559616";
			$content = $this->temp_amazon($url,'考试');
		}	

		// 经济学理论与读物
		for($i = 1 ; $i <= 69 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143232071&page=$i&bbn=143231071&ie=UTF8&qid=1442559730";
			$content = $this->temp_amazon($url,' 经济学理论与读物');
		}	

		// 管理学
		for($i = 1 ; $i <= 57 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143233071&page=$i&bbn=143231071&ie=UTF8&qid=1442559797";
			$content = $this->temp_amazon($url,' 管理学');
		}	

		// 企业经营与管理
		for($i = 1 ; $i <= 229 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143234071&page=$i&bbn=143231071&ie=UTF8&qid=1442559869";
			$content = $this->temp_amazon($url,' 企业经营与管理');
		}

		// 投资理财
		for($i = 1 ; $i <= 131 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143235071&page=$i&bbn=143231071&ie=UTF8&qid=1442559915";
			$content = $this->temp_amazon($url,' 投资理财');
		}

		// 会计审计
		for($i = 1 ; $i <= 41 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143236071&page=$i&bbn=143231071&ie=UTF8&qid=1442559963";
			$content = $this->temp_amazon($url,' 会计审计');
		}

		// 行业经济
		for($i = 1 ; $i <= 142 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143237071&page=$i&bbn=143231071&ie=UTF8&qid=1442560001";
			$content = $this->temp_amazon($url,' 行业经济');
		}

		// 市场营销
		for($i = 1 ; $i <= 85 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143238071&page=$i&bbn=143231071&ie=UTF8&qid=1442560043";
			$content = $this->temp_amazon($url,' 市场营销');
		}


		// 贸易经济
		for($i = 1 ; $i <= 165 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143231071%2Cn%3A143240071&page=$i&bbn=143231071&ie=UTF8&qid=1442560144";
			$content = $this->temp_amazon($url,' 贸易经济');
		}

		// 教材教辅与参考书
		for($i = 1 ; $i <= 376 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143215071&page=$i&bbn=116169071&ie=UTF8&qid=1442560216";
			$content = $this->temp_amazon($url,' 教材教辅与参考书');
		}

		// 儿童文学
		for($i = 1 ; $i <= 400 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143276071%2Cn%3A143278071&page=$i&bbn=143276071&ie=UTF8&qid=1442560268";
			$content = $this->temp_amazon($url,' 儿童文学');
		}

		// 孕产育儿
		for($i = 1 ; $i <= 67 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143290071&page=$i&bbn=116169071&ie=UTF8&qid=1442560310";
			$content = $this->temp_amazon($url,' 孕产育儿');
		}

		// 家庭教育
		for($i = 1 ; $i <= 86 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143291071&page=$i&bbn=116169071&ie=UTF8&qid=1442560350";
			$content = $this->temp_amazon($url,' 家庭教育');
		}

		// 时尚
		for($i = 1 ; $i <= 69 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143254071&page=$i&bbn=116169071&ie=UTF8&qid=1442560397";
			$content = $this->temp_amazon($url,' 时尚');
		}

		// 娱乐
		for($i = 1 ; $i <= 110 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143267071&page=$i&bbn=116169071&ie=UTF8&qid=1442560440";
			$content = $this->temp_amazon($url,' 娱乐');
		}

		// 健康与养生
		for($i = 1 ; $i <= 254 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143292071&page=$i&bbn=116169071&ie=UTF8&qid=1442560486";
			$content = $this->temp_amazon($url,' 健康与养生');
		}


		// 家居休闲
		for($i = 1 ; $i <= 34 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143293071&page=$i&bbn=116169071&ie=UTF8&qid=1442560531";
			$content = $this->temp_amazon($url,' 家居休闲');
		}

		// 旅游与地图
		for($i = 1 ; $i <= 123 ; $i++){

			$url ="http://www.amazon.cn/s/ref=lp_143304071_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143304071&page=$i&ie=UTF8&qid=1442560582";
			$content = $this->temp_amazon($url,' 旅游与地图');
		}

		// 动漫与绘本
		for($i = 1 ; $i <= 96 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143305071&page=$i&bbn=116169071&ie=UTF8&qid=1442560624";
			$content = $this->temp_amazon($url,' 动漫与绘本');
		}

		// 烹饪美食与酒
		for($i = 1 ; $i <= 164 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143306071&page=$i&bbn=116169071&ie=UTF8&qid=1442560681";
			$content = $this->temp_amazon($url,' 烹饪美食与酒');
		}


		// 英语与其他外语
		for($i = 1 ; $i <= 350 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143324071&page=$i&bbn=116169071&ie=UTF8&qid=1442560726";
			$content = $this->temp_amazon($url,' 英语与其他外语');
		}


		// 婚恋与两性
		for($i = 1 ; $i <= 66 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143354071&page=$i&bbn=116169071&ie=UTF8&qid=1442560768";
			$content = $this->temp_amazon($url,' 婚恋与两性');
		}

		// 计算机与互联网
		for($i = 1 ; $i <= 281 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143359071&page=$i&bbn=116169071&ie=UTF8&qid=1442560818";
			$content = $this->temp_amazon($url,' 计算机与互联网');
		}

		// 社会科学
		for($i = 1 ; $i <= 400 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143381071&page=$i&bbn=116169071&ie=UTF8&qid=1442560868";
			$content = $this->temp_amazon($url,' 社会科学');
		}

		// 法律
		for($i = 1 ; $i <= 245 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143387071&page=$i&bbn=116169071&ie=UTF8&qid=1442560911";
			$content = $this->temp_amazon($url,' 法律');
		}


		// 心理学
		for($i = 1 ; $i <= 320 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143411071&page=$i&bbn=116169071&ie=UTF8&qid=1442560949";
			$content = $this->temp_amazon($url,' 心理学');
		}


		// 历史
		for($i = 1 ; $i <= 308 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143428071&page=$i&bbn=116169071&ie=UTF8&qid=1442560996";
			$content = $this->temp_amazon($url,' 历史');
		}

		// 国学
		for($i = 1 ; $i <= 178 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143442071&page=$i&bbn=116169071&ie=UTF8&qid=1442561063";
			$content = $this->temp_amazon($url,' 国学');
		}

		// 哲学与宗教
		for($i = 1 ; $i <= 400 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143452071&page=$i&bbn=116169071&ie=UTF8&qid=1442561114";
			$content = $this->temp_amazon($url,' 哲学与宗教');
		}

		// 政治与军事
		for($i = 1 ; $i <= 333 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143468071&page=$i&bbn=116169071&ie=UTF8&qid=1442561158";
			$content = $this->temp_amazon($url,' 政治与军事');
		}
		// 医学
		for($i = 1 ; $i <= 363 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143478071&page=$i&bbn=116169071&ie=UTF8&qid=1442561200";
			$content = $this->temp_amazon($url,' 医学');
		}

		// 科学与自然
		for($i = 1 ; $i <= 210 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143509071&page=$i&bbn=116169071&ie=UTF8&qid=1442561235";
			$content = $this->temp_amazon($url,' 科学与自然');
		}

		// 科技
		for($i = 1 ; $i <= 247 ; $i++){

			$url ="http://www.amazon.cn/s/ref=sr_pg_2?fst=as%3Aoff&rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143528071&page=$i&bbn=116169071&ie=UTF8&qid=1442561276";
			$content = $this->temp_amazon($url,' 科技');
		}

		//  杂志新阅
		for($i = 1 ; $i <= 142 ; $i++){

			$url ="http://www.amazon.cn/s/ref=lp_143583071_pg_2?rh=n%3A116087071%2Cn%3A!116088071%2Cn%3A116169071%2Cn%3A143579071%2Cn%3A143583071&page=$i&ie=UTF8&qid=1442561354";
			$content = $this->temp_amazon($url,'杂志新阅');
		}

	}


	public function run(){




	}


	public function temp_amazon($url, $tag ){

		require_once ( APPPATH.'libraries/simple_html_dom.class.php' );
		$html = url2html( $url , $this->header ); 
        if( $html ){

	        $li =  $html->find('li[class=s-result-item celwidget]');
	       // var_dump($title);
	        foreach ($li as $l) {

	        	 $href   = $l->find('a',0)->href;
	        	 $title  = $l->find('div[class=a-fixed-left-grid-col a-col-right] a h2',0)->plaintext;
	        	 $author = $l->find('div[class=a-row a-spacing-none]',0)->plaintext;
	        	 $price  = $l->find('span[class=a-size-base a-color-price s-price a-text-bold]',0)->plaintext;
	        	 $price  = str_replace('￥','',$price);
	        	 echo $price.'<br>';
	        	 echo $author.'<br>';
	        	 echo $title . '<br>';
			     $data['url']	  	= urldecode($href).'&tag=zhaoshu114-23';
	        	 $data['md5_url'] 	= md5($href);
	        	 $data['title']   	= mb_convert_encoding($title , 'UTF-8' ,'HTML-ENTITIES');
	        	 $data['author']  	= $author;
	        	 $data['price']	  	= $price;
	        	 $data['from_site'] = 'amazon';
	        	 $data['type']	  	= 3;
	        	 $data['tag']	  	= $tag;
	        	 $this->insert_db($data);
	        	
	        }

	        $html->clear();

        }else {
        	return 0;
        }
	}

	function insert_db($data){

		       $query   = $this->db->query(  "select id from docs where  md5_url = '". md5($data['url'])."'" );
		       $res_num = $query->num_rows() ;
		       if( $res_num > 0 ){
					echo "已有 \n";    
		       }else {
					$res  = $this->db->insert( 'docs' , $data );
					if( $res ){
						echo "插入成功 \n";
					}
		       }
	}

}
