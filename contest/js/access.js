function request_access(task_id) {
	api_post("/open.php", "task_id="+task_id);
	window.location = "/contest/problem.php?task_id="+task_id;
}
