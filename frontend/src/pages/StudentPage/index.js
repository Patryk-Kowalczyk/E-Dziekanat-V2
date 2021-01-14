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

const HomePage = lazy(() => import("./SubPages/HomePage"));
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));
const FinalGradesPage = lazy(() => import("./SubPages/FinalGradesPage"));
const PartialGradesPage = lazy(() => import("./SubPages/PartialGradesPage"));

function App() {
  const dispatch = useDispatch();

  const config = {
    headers: header(),
  };

  useEffect(() => {
    axios
      .get("http://createosm.pl/IPZ/backend/public/api/auth/dashboard", config)
      .then((response) => {
        console.log(response);
        const data = response.data.student_data;
        dispatch(login(data));
        dispatch(setInfo({ day_plan: response.data.day_plan }));
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
            <Route path="/student" component={HomePage} exact />
            <Route path="/student/plan-zajec" component={TimeTablePage} />
            <Route path="/student/oceny" component={FinalGradesPage} />
            <Route
              path="/student/oceny-czastkowe"
              component={PartialGradesPage}
            />
          </Switch>
        </Suspense>
      </div>
      <UserMenu open={isMenuOpen} setopen={setIsMenuOpen} />
    </div>
  );
}

export default function index() {
  return <App />;
}
