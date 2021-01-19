import React, {Suspense, useState, lazy} from "react";
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
import data from './endpoints/dashboard.json';

const HomePage = lazy(() => import("./SubPages/HomePage"));
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));
const IndividualMarks = lazy(() => import("./SubPages/IndividualMarks"));

const LoggedUser = {
    firstname: "Grażyna",
    lastname: "Żarko",
    index: "gż3322",
    avatar:
        "https://tmtown.s3.amazonaws.com/uploads/user/image/328772/super_large_hochnadel_avatar.jpg",
};


function App() {
    const dispatch = useDispatch();
    dispatch(login(LoggedUser));
    dispatch(
        setInfo({
            day_plan: data.day_plan,
        }))

    // const config = {
    //     headers: header(),
    // };
    //
    // useEffect(() => {
    //     axios
    //         .get(API_URL + "dashboard", config)
    //         .then((response) => {
    //             console.log(response);
    //             const data = response.data.student_data;
    //             dispatch(login(data));
    //             dispatch(
    //                 setInfo({
    //                     day_plan: response.data.day_plan,
    //                     avg_grades: response.data.avg_grades,
    //                     last_grades: response.data.last_grades,
    //                 })
    //             );
    //         })
    //         .catch((err) => console.error(err));
    // }, []);


    const [isMenuOpen, setIsMenuOpen] = useState(false);

    return (
        <div className="user-page">
            <LeftMenu open={isMenuOpen} setopen={setIsMenuOpen}/>
            <div className="content">
                <Suspense fallback={<div className="loading"></div>}>
                    <Switch>
                        <Route path="/teacher" component={HomePage} exact/>
                        <Route path="/teacher/plan-zajec/" component={TimeTablePage}/>
                        <Route path="/teacher/oceny-czastkowe/" component={IndividualMarks}/>
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
