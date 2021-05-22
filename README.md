# Kyunghee-Club-Evaluation
## <경희대학교 중앙동아리 평가 사이트>

> 신입생들이 중앙동아리에 대한 정보를 얻기 어려움에 따라 동아리원이 직접 후기와 평점을 남길 수 있는 사이트를 개발하여 의사결정에 도움을 주고자 한다.

## Table of Contents
_Note: This is only a navigation guide for the specification, and does not define or mandate terms for any specification-compliant documents._

- [Sections](#sections)
  - [Title](#title)
  - [Methodology](#methodology)
  - [Stacks](#stacks)
  - [Preview](#preview)
  - [Maintainers](#maintainers)

## Sections

### Title
-경희대학교 중앙동아리 평가 사이트

### Methodology

**Frontend**
- Jquery : HTML의 클라이언트 사이드 조작을 단순화 하도록 설계된 크로스 플랫폼의 자바스크립트 라이브러리다.
- Ajax :  DB 종목 리스트 Return, 최적화, 백테스트, 뉴스 수집 등 비동기 통신에 사용
- HTML5
- CSS
> Reference : Wylie

**Backend**
- PHP_CodeIgniter : PHP 기반으로 오픈소스이고, 무료로 사용 할 수 있는 프래임워크이다. PHP 프래임워크 중에 가장 많은 사용자 층을 가지고 있는 프래임 웍 중의 하나고, 빠르고 MVC 모델을 지원한다. 특히 한국에는 코드 이그나이터 커뮤니티가 있어서 다양한 정보 교류가 가능하다. 

**DataBase**
-Tables
  * clubinfo : 중앙동아리의 기본정보를 담은 테이블이다. 
  
  ![image](https://user-images.githubusercontent.com/56333934/119215699-5bd9ce80-bb0a-11eb-974f-66b9e5b2ce95.png)
  
  * clubhead : 동아리장 계정 테이블이다.
  
  ![image](https://user-images.githubusercontent.com/56333934/119215711-7c098d80-bb0a-11eb-89ef-5bfdb94282d2.png)
  
  * clubmember : 동아리원 계정 테이블이다.
  
  ![image](https://user-images.githubusercontent.com/56333934/119215727-8d529a00-bb0a-11eb-8106-38b06d155511.png)
  
  * clubpicture : 동아리별 대표 사진이 저장되어 있는 테이블이다. -> pic_path가 [경희대학교 중앙동아리로 링크되어있다]
  
  * clubreview : 후기 데이터가 저장된 테이블이다. 
  
  ![image](https://user-images.githubusercontent.com/56333934/119216795-bc6c0a00-bb10-11eb-9c54-9d977e14d009.png)
  
  * comment : 대댓글 데이터가 저장된 테이블이다.
  
   ![image](https://user-images.githubusercontent.com/56333934/119216815-defe2300-bb10-11eb-8ac0-7b9a05048db3.png)


### Stacks
- `PHP CodeIgniter`, `Jquery`, `Mysql Database`

### Preview
![image](https://user-images.githubusercontent.com/56333934/119217060-a2cbc200-bb12-11eb-8335-ea252bf90013.png)

[클릭하여 영상보기](https://youtu.be/HC85-VIkuB8)

코로나로 인해 서비스를 하고 있지 않은 관계로 도메인 연장을 하지 않고 있습니다. 

### Maintainers
- 신시언 : Full Stack 개발. 
