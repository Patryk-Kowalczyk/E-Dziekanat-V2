import React, {Suspense, lazy} from "react";
import {Route, Switch, NavLink, Redirect} from "react-router-dom";
import "./timetable.scss";

const DaysTable = lazy(() => import("./DaysTable"));
const WeekTable = lazy(() => import("./WeekTable"));

export default function index() {
    return (
        <div className="timetable">
            <h1>Plan zajęć</h1>
            <div className="timetable-pick">
                <div className="picker">
                    <NavLink
                        to="/teacher/plan-zajec/dzien"
                        className="pick"
                        activeClassName="active"
                    >
                        Dzienny
                    </NavLink>
                    <NavLink
                        to="/teacher/plan-zajec/tydzien"
                        className="pick"
                        activeClassName="active"
                    >
                        Tygodniowy
                    </NavLink>
                </div>
            </div>
            <div className="timetable-table">
                <Suspense fallback={<div className="loading"></div>}>
                    <Switch>
                        <Route path="/teacher/plan-zajec/dzien" component={DaysTable}/>
                        <Route
                            exact
                            path="/teacher/plan-zajec/tydzien"
                            component={WeekTable}
                        />
                        <Route exact>
                            <Redirect to="/teacher/plan-zajec/tydzien"/>
                        </Route>
                    </Switch>
                </Suspense>
            </div>
        </div>
    );
}
