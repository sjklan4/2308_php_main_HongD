-- 직책 테이블의 모든 정보를 조회
SELECT *
from titles;

-- 급여가 60,000 이하인 사원의 사번을 조회해주세요
SELECT emp_no
FROM salaries
WHERE salary <=60000;


-- 급여가 60,000에서 70,000인 사원의 사번
SELECT *
FROM salaries
WHERE salary >= 60000
AND salary <= 70000;

-- 사원번호가 10001,10005인 사원의 모든 정보 
SELECT *
FROM employees
WHERE emp_no = 10001
OR emp_no = 10005;

-- 현재 재직중인 10001,10005번 사원의 모든 정보(직책,직책명 포함)
SELECT 
emp.*
,dmp.dept_no
,tit.title
,dept.dept_name
,sal.salary

FROM employees emp
	JOIN dept_emp dmp
		ON emp.emp_no = dmp.emp_no
		AND dmp.to_date >=NOW()
	JOIN titles tit
		ON emp.emp_no = tit.emp_no
		AND tit.to_date >=NOW()
	JOIN salaries sal
		ON emp.emp_no = sal.emp_no
		AND sal.to_date >=NOW()
	JOIN departments dept
		ON dmp.dept_no = dept.dept_no
WHERE emp.emp_no = 10001
OR emp.emp_no = 10005;

-- 직급명에 engineer가 포함된 사원의 사번과 직급 조회
SELECT emp.emp_no,tit.title
FROM employees emp
	JOIN titles tit
	ON emp.emp_no = tit.emp_no
	AND tit.title LIKE '%engineer%'
	AND tit.to_date>=NOW();
	
	
	
SELECT emp_no,title
FROM titles
WHERE title  LIKE('%engineer%');

-- 사원 이름을 오름차순으로 정렬해서 조회
SELECT *
FROM employees
ORDER BY first_name;

SELECT concat(first_name,'',last_name) full_name
FROM employees
ORDER BY full_name;


-- 사원별 급여의 평균을 조회
SELECT emp_no,AVG(salary) AS 급여평균
FROM salaries
GROUP BY	emp_no;

SELECT emp_no,ceil(AVG(salary)) AS avgsal
FROM salaries 
GROUP BY emp_no;
 
-- 사원별 급여의 평균이 30,000 -50,000/ 사원번호 평균급여
SELECT emp_no,AVG(salary)
FROM salaries
GROUP BY emp_no
HAVING AVG(salary) >=30000
AND AVG(salary) <=50000;


SELECT emp_no,AVG(salary)
FROM salaries
GROUP BY emp_no
HAVING AVG(salary) >=30000
AND AVG(salary) <=50000
ORDER BY AVG(salary) desc;

-- 사원별 급여 평균이 70,000이상 사번 이름 성 성별 조회
SELECT 
	emp.emp_no
	,emp.first_name
	,emp.last_name
	,emp.gender
FROM employees AS emp
	JOIN salaries AS sal
	ON emp.emp_no = sal.emp_no 
GROUP BY sal.emp_no
HAVING AVG(sal.salary)>=70000;


SELECT 
emp.emp_no
,emp.first_name
,emp.last_name
,emp.gender
FROM employees emp
	JOIN(SELECT 
	emp_no, CEIL(AVG(salary)) avgsal
	FROM salaries
	GROUP BY emp_no
	HAVING avgsal >= 70000
) sal
 ON emp.emp_no = sal.emp_no;





-- 현재 직책이 senior engineer 인 사원의 사원번호와 성 조회

SELECT 
emp.emp_no
,emp.first_name
,emp.last_name
,tit.title
FROM employees AS emp
	JOIN titles AS tit
	ON emp.emp_no = tit.emp_no	
WHERE tit.title = "Senior Engineer" 
	AND tit.to_date >= NOW();