import React, { Suspense, lazy } from "react";
import "./App.scss";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import { Provider } from "react-redux";
import store from "./store";
import refresh from "./services/refresh";

const StudentPage = lazy(() => import("./pages/StudentPage"));
const TeacherPage = lazy(() => import("./pages/TeacherPage"));
const LoginPage = lazy(() => import("./pages/LoginPage"));

export default function App() {
  refresh();
  return (
    <Provider store={store}>
      <Router>
        <Suspense fallback={<div className="loading"></div>}>
          <Switch>
            <Route path="/" component={LoginPage} exact />
            <Route path="/student" component={StudentPage} />
            <Route path="/teacher" component={TeacherPage} />
          </Switch>
        </Suspense>
      </Router>
    </Provider>
  );
}
