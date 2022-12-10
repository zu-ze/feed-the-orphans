import React, { useState } from "react";
import { StyleSheet, Text, View, TouchableOpacity, Button, FlatList} from "react-native";
import {TextInput, Surface, Snackbar, ActivityIndicator, Card, Paragraph, Avatar, Title} from "react-native-paper";
// import Card from "../card";
import Ionicons from 'react-native-vector-icons/Ionicons';
import FontAwesome, {
    SolidIcons,
    RegularIcons,
    BrandIcons,
    parseIconFromClassName
} from "react-native-fontawesome"

export const Pop = ({show, type, message}) => {
    const [visible, setVisible] = React.useState(show);
    const onToggleSnackBar = () => setVisible(!visible);
    const onDismissSnackBar = () => setVisible(false);

    return (
            <Snackbar
                visible={visible}
                onDismiss={onDismissSnackBar}
                style={{
                    backgroundColor: "#4b88a2"
                }}
                action={{
                }}
            >
                {message}
            </Snackbar>
    )
}


/*
##################################################################################

HOME TAB

#################################################################################
*/
export const HomeScreen = ({navigation}) => {

    return (
        <View
            style={[styles.container, {flexDirection: "row"}]}
        >
            <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onPress={() => navigation.navigate('MyArea')}>
                <View >
                    <Ionicons name="map" color="white" size={50} />
                    {/* <FontAwesome size={50} icon={BrandIcons.facebook} /> */}
                    <Text style={styles.text}>My Area</Text>
                </View>
            </TouchableOpacity>
            <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                onPress={() => navigation.navigate("Events")}
            >
                <View>
                    <Ionicons name="person" color="white" size={50} />
                    <Text style={styles.text}>Events</Text>
                </View>                
            </TouchableOpacity>
            <TouchableOpacity style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                onPress={() => navigation.navigate("Find")}
            >
                <View>
                    <Ionicons name="search" color="white" size={50} />
                    <Text style={styles.text}>Find</Text>
                </View>
            </TouchableOpacity>
            <TouchableOpacity  style={[ styles.box, {backgroundColor: "#4b88a2" }]}
                onPress={() => navigation.navigate("Donate")}
            >
                <View>
                    <Ionicons name="wallet" color="white" size={50} />
                    <Text style={styles.text}>Donate</Text>
                </View>
            </TouchableOpacity>
        </View>
    )
}

export const MyAreaScreen = ({navigation}) => {
    const [visible, setVisible] = React.useState(true);
    const onToggleSnackBar = () => setVisible(!visible);
    const onDismissSnackBar = () => setVisible(false);


    return (
        <View style={[styles.container, {flexDirection: "row"}]}>
            <Snackbar
                visible={visible}
                onDismiss={onDismissSnackBar}
                style={{
                    backgroundColor: "#4b88a2"
                }}
                action={{
                    label: "View",
                    onPress: () => {

                    }
                }}
            >
                Save the children is 100km from you.
            </Snackbar>
        </View>
    )
}

export const EventsScreen = ({navigation}) => {
    const [isLoggedIn, setLoggedIn] = React.useState(true)
    const [events, setEvents] = React.useState([
        {
            orphanage: "Save The Children",
            title: "Test Event one",
            description: "This is the description of test event one"
        },
        {
            orphanage: "yoneko",
            title: "Test Event two",
            description: "This is the description of test event two"
        },
        {
            orphanage: "Mzuzu crisis nursery",
            title: "Test Event Three",
            description: "This is the description of test event Three"
        },
    ])

    const CardComponent = ({item}) => {
        const LeftContent = props => <Avatar.Icon size={30} icon="folder" /> 

        return (
            <Surface style={{marginBottom: 10}}>
            <Card style={{backgroundColor: "#c5d5e4"}}>
                <Card.Title title={item.orphanage} left={LeftContent} />
                <Card.Content>
                    <Title>{item.title}</Title>
                    <Paragraph>{item.description}</Paragraph>
                </Card.Content>
                <Card.Cover style={{margin: 5}} source={require('../image.png')} />
                <Card.Actions>
                    <Button title="Cancel" />
                    <Button title="Ok" />
                </Card.Actions>
            </Card>
            </Surface>
        )
    }

    return (
        <View style={[styles.container, {flexDirection: "row"}]} >
            {isLoggedIn?
                <View style={{ flex: 1, alignItems: 'top', justifyContent: 'center', height: "100%", width: "100%" }} >
                    <FlatList 
                        data={events} 
                        renderItem={({item}) => <CardComponent item={item} /> } 
                    />
                </View>
            :
                <View style={[styles.box,{backgroundColor: "#4b88a2", width: "80%", height: "40%"}]} >
                    <Text style={[styles.text]} >You Must Be Logged In to View Events</Text>
                </View>
            }
        </View>
    )
}

export const FindScreen = ({navigation}) => {
    return (
        <View style={[styles.container, {flexDirection: "row" }]} >
            <View>
                <TextInput
                    label="Search"
                    mode="outlined"
                />
                <View style={{paddingTop: 5}} >
                    <Button
                        title="Done"
                        onPress={ () => {
                        }}
                    />
                </View>
            </View>
        </View>
    )
} 

export const DonateScreen = ({navigation}) => {
    return (
        <View style={[styles.container, {flexDirection: "row" }]} >
                <Text style={{fontSize: 18, color: "#4b88a2", textAlign: "center"}} >Perform the transation before filling in the details</Text>
            <View>
                <TextInput
                    label="DonationType"
                    mode="outlined"
                />
                <TextInput
                    label="TransationId"
                    textContentType="emailAddress"
                    mode="outlined"
                />
                <TextInput
                    label="Phone"
                    mode="outlined"
                />
                <TextInput
                    label="OrphanageName"
                    mode="outlined"
                />
                <View style={{paddingTop: 5}} >
                    <Button
                        title="Done"
                        onPress={ () => {
                        }}
                    />
                </View>
            </View>     
        </View>
    )
} 

/*
##################################################################################

USER TAB

#################################################################################
*/

export const UserHomeScreen = ({navigation, route }) => {
    const [isLoggedIn, setLoggedIn] = React.useState(true)
    const [message, setMessage] = React.useState("");
    const [visible, setVisible] = React.useState(false);

    React.useEffect(() => {
        if (route.params?.isLoggedIn)
            setLoggedIn(route.params.isLoggedIn)
        if (route.params?.response) {
            if (route.params.response.status === true)
                setMessage(route.params.response.message)
                setVisible(true)
        }
    }, [route.params?.isLoggedIn])

    return (
    <View
        style={[styles.container, {flexDirection: "row"}]}
    >
        {isLoggedIn ?
            <View style={[styles.row]}>
                <Surface style={[ styles.box, {backgroundColor: "#4b88a2" }]} >
                    <View>
                        <Ionicons name="person" color="white" size={50} />
                        <Text style={styles.text}>Profile</Text>
                    </View>
                </Surface>
                <Surface style={[ styles.box, {backgroundColor: "#4b88a2" }]} >
                    <View>
                        <Ionicons name="log-out" color="white" size={50} />
                        <Text style={styles.text}>Logout</Text>
                    </View>
                </Surface>
                <Pop show={visible} type="success" message={message}/>
            </View>
        : 
            <View style={[styles.row]} >
                <Surface style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onClick={() => navigation.navigate('Register')}
                >
                    <View>
                        <Ionicons name="person-add" color="white" size={50} />
                        <Text style={styles.text}>Register</Text>
                    </View>
                </Surface>
                <Surface style={[ styles.box, {backgroundColor: "#4b88a2" }]} 
                    onClick={() => navigation.navigate("Login")}
                >
                    <View>
                        <Ionicons name="log-in" color="white" size={50} />
                        <Text style={styles.text}>Login</Text>
                    </View>
                </Surface>
            </View>
        }
    </View>
    )
}

export const RegisterScreen = ({navigation})  => {
    const [role, setRole] = React.useState("donor");
    const [status, setStatus] = React.useState("active");
    const [userName, setUserName] = React.useState('');
    const [email, setEmail] = React.useState('');
    const [phone, setPhone] = React.useState('');
    const [password, setPassword] = React.useState('');

    const [isLoading, setLoading] = React.useState(false)

    // const [res, setRes] = React.useState()


    const Register = async () => {
        try {
            const response = await fetch('http://localhost/PHP/REST_API/fto/user/register.php', {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    role: role,
                    status: status,
                    userName: userName,
                    email: email,
                    phone: phone,
                    password: password,
                }),
            });
            const json = await response.json();

            if(json.status === true){
                setLoading(false);
                navigation.navigate('Users', {
                    isLoggedIn: true,
                    response: json,
                })
            }
            else {
                setLoading(false);

            }
        }catch(error) {
            console.error(error);
        } 
    }

    return (
        <View style={[styles.container, {backgroundColor: '#e2e2e2' }]}>

            {isLoading ? <ActivityIndicator color="#4b88a2" size="large" /> : 
            <View>
                <TextInput
                    label="username"
                    onChangeText={setUserName}
                    value={userName}
                    mode="outlined"
                />
                <TextInput
                    label="email"
                    textContentType="emailAddress"
                    onChangeText={setEmail}
                    value={email}
                    mode="outlined"
                />
                <TextInput
                    label="phone"
                    textContentType
                    onChangeText={setPhone}
                    value={phone}
                    mode="outlined"
                />
                <TextInput
                    label="password"
                    textContentType="password"
                    onChangeText={setPassword}
                    value={password}
                    mode="outlined"
                />
                <View style={{paddingTop: 5}} >
                    <Button
                        title="Done"
                        onPress={ () => {
                            setLoading(true)
                            Register()

                        }}
                    />
                </View>
            </View>     
            }
    </View>
    )
}


export const LoginScreen = ({navigation}) => {
    const [email, setEmail] = React.useState('');
    const [password, setPassword] = React.useState('');

    const [isLoading, setLoading] = React.useState(false)

    const Login = async () => {
        try {
            const response = await fetch('http://localhost/PHP/REST_API/fto/user/login.php', {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                }),
            });
            const json = await response.json();

            if(json.status === true){
                setLoading(false);
                navigation.navigate('Users', {
                    isLoggedIn: true,
                    response: json,
                })
            }
            else {
                setLoading(false);
            }
        }catch(error) {
            console.error(error);
        } 
    }

    return (
        <View style={[styles.container, {backgroundColor: '#e2e2e2' }]} >
            {isLoading? <ActivityIndicator color="#4b88a2" size="large" /> :
                <View>
                    <View>
                        <TextInput
                            label="email"
                            textContentType="emailAddress"
                            onChangeText={setEmail}
                            value={email}
                            mode="outlined"
                        />
                    </View>
                    <View>
                        <TextInput
                            label="password"
                            textContentType="password"
                            onChangeText={setPassword}
                            value={password}
                            mode="outlined"
                        />
                    </View>
                    <View style={{paddingTop: 5}} >
                        <Button
                            title="Done"
                            style={styles.button}
                            onPress={ () => {
                                setLoading(true)
                                Login()
                            }}
                        />
                    </View>
                    <Pop show={false} />
                </View>
            }
        </View>
    )
}

export const UserProfile = () => {

    return (
        <View style={[styles.container]} >
            <View>
                <Avatar />
            </View>
            <View>

            </View>
        </View>
    )
} 

/**
 * ###############################################################################
 * 
 * 
 * 
 * ###############################################################################
 */

export const NotificationScreen = () => {
    return (
        <View>
            
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        margin: 0,
        // backgroundColor: "aliceblue",
        backgroundColor: '#e2e2e2',
        padding: 5,
        flexWrap: "wrap",
        alignContent: "center",
        justifyContent: "center"
    },
    box: {
        height: "25%",
        width: "45%",
        margin: 2,
        borderRadius: 5,
        textAlign: "center",
        justifyContent: "center"
    },
    row: {
        flexDirection: "row",
        flexWrap: "wrap",
        width: "100%",
        height: "100%",
        justifyContent: "center",
        alignContent: "center"
    },
    button: {
        paddingHorizontal: 8,
        paddingVertical: 6,
        borderRadius: 4,
        backgroundColor: "oldlace",
        alignSelf: "flex-start",
        marginHorizontal: "1%",
        marginBottom: 6,
        minWidth: "48%",
        textAlign: "center",
    },
    selected: {
        backgroundColor: "coral",
        borderWidth: 0,
    },
    buttonLabel: {
        fontSize: 12,
        fontWeight: "500",
        color: "coral",
    },
    selectedLabel: {
        color: "white",
    }, 
    label: {
        textAlign: "center",
        marginBottom: 10,
        fontSize: 24,
    },
    text: {
        fontSize: 24,
        color: "#fff"
    }
});
