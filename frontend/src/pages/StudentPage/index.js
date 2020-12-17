import React, { Suspense, useState, lazy } from "react";
import "./studentpage.scss";
import LeftMenu from "./LeftMenu";
import UserMenu from "./UserMenu";
import { Switch, Route } from "react-router-dom";
import { useDispatch } from "react-redux";
import { login } from "../../actions/auth";

const HomePage = lazy(() => import("./SubPages/HomePage"));
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));
const FinalGradesPage = lazy(() => import("./SubPages/FinalGradesPage"));

const LoggedUser = {
  firstname: "Jan",
  lastname: "Kowalski",
  index: "jk12345",
  avatar:
    "https://www.tm-town.com/assets/default_male600x600-79218392a28f78af249216e097aaf683.png",
};

function App() {
  const dispatch = useDispatch();
  dispatch(login(LoggedUser));

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
