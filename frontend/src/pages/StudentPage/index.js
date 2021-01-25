import React, { Suspense, useState, lazy, useEffect } from "react";
import "./studentpage.scss";
import LeftMenu from "./LeftMenu";
import UserMenu from "./UserMenu";
import { Switch, Route } from "react-router-dom";
import { useDispatch } from "react-redux";
import { login } from "../../actions/auth";
import { setInfo } from "../../actions/info";
import header from "../../services/auth-header";
import axios from "axios";
import API_URL from "../../services/API_URL";

const HomePage = lazy(() => import("./SubPages/HomePage"));
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));
const FinalGradesPage = lazy(() => import("./SubPages/FinalGradesPage"));
const PartialGradesPage = lazy(() => import("./SubPages/PartialGradesPage"));
const AnnoucmentsPage = lazy(() => import("./SubPages/AnnoucmentsPage"));
const AnnoucmentPage = lazy(() =>
  import("./SubPages/AnnoucmentsPage/AnnoucmentPage")
);
const FinancialData = lazy(() => import("./SubPages/FinancialData"));
const FinancialPayments = lazy(() =>
  import("./SubPages/FinancialData/FinancialPayments.js")
);
const UserInfoPage = lazy(() => import("./SubPages/UserInfoPage"));
const SelectionPage = lazy(() => import("./SubPages/SelectionPage"));

function App() {
  const dispatch = useDispatch();

  const config = {
    headers: header(),
  };

  useEffect(() => {
    axios
      .get(API_URL + "student/dashboard", config)
      .then((response) => {
        console.log(response);
        const data = response.data.student_data;
        dispatch(login(data));
        dispatch(
          setInfo({
            day_plan: response.data.day_plan,
            avg_grades: response.data.avg_grades,
            last_grades: response.data.last_grades,
          })
        );
      })
      .catch((err) => console.error(err));
  }, []);

  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <div className="user-page">
      <LeftMenu open={isMenuOpen} setopen={setIsMenuOpen} />
      <div className="content-box">
        <div className="content">
          <Suspense fallback={<div className="loading"></div>}>
            <Switch>
              <Route path="/student" component={HomePage} exact />
              <Route path="/student/plan-zajec" component={TimeTablePage} />
              <Route path="/student/oceny" component={FinalGradesPage} />
              <Route
                path="/student/oceny-czastkowe"
                component={PartialGradesPage}
              />
              <Route
                path="/student/wiadomosci"
                exact
                component={AnnoucmentsPage}
              />
              <Route
                path="/student/wiadomosci/:id"
                component={AnnoucmentPage}
              />
              <Route
                path="/student/dane-finansowe"
                exact
                component={FinancialData}
              />
              <Route
                path="/student/dane-finansowe/:id"
                component={FinancialPayments}
              />
              <Route path="/student/uczen" component={UserInfoPage} />
              <Route path="/student/wybor" component={SelectionPage} />
            </Switch>
          </Suspense>
        </div>
      </div>
      <UserMenu open={isMenuOpen} setopen={setIsMenuOpen} />
    </div>
  );
}

export default function index() {
  return <App />;
}
