import React, {Suspense, useState, lazy, useEffect} from "react";
import "./teacherpage.scss";
import LeftMenu from "./LeftMenu";

import TeacherMenu from './TeacherMenu';
import {useDispatch} from "react-redux";
import {login} from "../../actions/auth";
import {Route, Switch} from "react-router-dom";
import axios from "axios";
import API_URL from "../../services/API_URL";
import {setInfo} from "../../actions/info";
import header from "../../services/auth-header";

const HomePage = lazy(() => import("./SubPages/HomePage"));
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));
const IndividualMarks = lazy(() => import("./SubPages/IndividualMarks"));
const FinalMarks = lazy(() => import("./SubPages/FinalMarks"));
const AnnoucmentsPage = lazy(() => import("./SubPages/AnnoucmentsPage"));
const AnnoucmentPage = lazy(() =>
    import("./SubPages/AnnoucmentsPage/AnnoucmentPage")
);

function App() {
    const dispatch = useDispatch();

    const config = {
        headers: header(),
    };

    useEffect(() => {
        axios
            .get(API_URL + "educator/dashboard", config)
            .then((response) => {
                console.log(response);
                const data = response.data.teacher_data;
                console.log(data)
                dispatch(login(data));
                dispatch(
                    setInfo({
                        day_plan: response.data.day_plan,
                        meetings: response.data.meetings,
                    })
                );
            })
            .catch((err) => console.error(err));
    }, [])


    const [isMenuOpen, setIsMenuOpen] = useState(false);

    return (
        <div className="user-page">
            <LeftMenu open={isMenuOpen} setopen={setIsMenuOpen}/>
            <div className="content">
                <Suspense fallback={<div className="loading"></div>}>
                    <Switch>
                        <Route path="/educator" component={HomePage} exact/>
                        <Route path="/educator/plan-zajec/" component={TimeTablePage}/>
                        <Route path="/educator/oceny-czastkowe/" component={IndividualMarks}/>
                        <Route path="/educator/oceny/" component={FinalMarks}/>
                        <Route
                            path="/educator/wiadomosci"
                            exact
                            component={AnnoucmentsPage}
                        />
                        <Route path="/educator/wiadomosci/:id" component={AnnoucmentPage} />

                    </Switch>
                </Suspense>
            </div>
            <TeacherMenu open={isMenuOpen} setopen={setIsMenuOpen}/>
        </div>
    );
}

export default function index() {
    return <App/>;
}
