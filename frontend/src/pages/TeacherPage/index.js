import React, { Suspense, useState, lazy, useEffect } from "react";
import "./teacherpage.scss";
import LeftMenu from "./LeftMenu";

import TeacherMenu from "./TeacherMenu";
import { useDispatch } from "react-redux";
import { login } from "../../actions/auth";
import { Route, Switch } from "react-router-dom";
import axios from "axios";
import API_URL from "../../services/API_URL";
import { setInfo } from "../../actions/info";
import header from "../../services/auth-header";
import { setClasses } from "../../actions/classes";
import { setMarks } from "../../actions/marks";

const HomePage = lazy(() => import("./SubPages/HomePage"));
const FinancialData = lazy(() => import("./SubPages/FinancialData"));
const FinancialPayments = lazy(() =>
  import("./SubPages/FinancialData/FinancialPayments")
);
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));
const IndividualMarks = lazy(() => import("./SubPages/IndividualMarks"));
const FinalMarks = lazy(() => import("./SubPages/FinalMarks"));
const AnnoucmentsPage = lazy(() => import("./SubPages/AnnoucmentsPage"));
const AnnoucmentPage = lazy(() =>
  import("./SubPages/AnnoucmentsPage/AnnoucmentPage")
);
const TeacherInfo = lazy(() => import("./SubPages/TeacherInfoPage"));
const PollsPage = lazy(() => import("./SubPages/PollsPage"));
function App() {
  const dispatch = useDispatch();

  const config = {
    headers: header(),
  };

  useEffect(() => {
    axios
      .get(API_URL + "educator/dashboard", config)
      .then((response) => {
        const data = response.data.teacher_data;
        dispatch(login(data));
        dispatch(
          setInfo({
            day_plan: response.data.day_plan,
            meetings: response.data.meetings,
          })
        );
      })
      .catch((err) => console.error(err));

    axios
      .get(API_URL + "educator/partialGradesList", config)
      .then((response) => {
        const data = response.data;
        dispatch(
          setClasses({
            groups: data.groups,
          })
        );
      })
      .catch((err) => console.error(err));

    axios
      .get(API_URL + "educator/finalGradesList", config)
      .then((response) => {
        const data = response.data;
        dispatch(
          setMarks({
            finalGrades: data.finalGrades,
          })
        );
      })
      .catch((err) => console.error(err));
  }, []);

  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <div className="user-page">
      <LeftMenu open={isMenuOpen} setopen={setIsMenuOpen} />
      <div className="content">
        <Suspense fallback={<div className="loading"></div>}>
          <Switch>
            <Route path="/educator" component={HomePage} exact />
            <Route path="/educator/plan-zajec/" component={TimeTablePage} />
            <Route
              path="/educator/oceny-czastkowe/"
              component={IndividualMarks}
            />
            <Route
              path="/educator/dane-finansowe"
              exact
              component={FinancialData}
            />
            <Route
              path="/educator/dane-finansowe/:id"
              component={FinancialPayments}
            />
            <Route path="/educator/oceny/" component={FinalMarks} />
            <Route
              path="/educator/wiadomosci"
              exact
              component={AnnoucmentsPage}
            />
            <Route path="/educator/wiadomosci/:id" component={AnnoucmentPage} />
            <Route path="/educator/ustawienia/" component={TeacherInfo} />
            <Route path="/educator/ankiety" component={PollsPage} />
          </Switch>
        </Suspense>
      </div>
      <TeacherMenu open={isMenuOpen} setopen={setIsMenuOpen} />
    </div>
  );
}

export default function index() {
  return <App />;
}
