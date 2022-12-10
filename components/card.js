import React, { useState } from "react";
import { StyleSheet, Text, View, TouchableOpacity} from "react-native";
import {Avatar, Button, Card, Title, Paragraph} from "react-native-paper"

const LeftContent = props => <Avatar.Icon {...props} icon="folder" /> 

export const CardComponent = ({item, show})  => {
    return (
        <Card style={[styles.box]}>
            <Card.Title title="Card Title" subtitle="Card Subtitle" left={LeftContent} />
            <Card.Content>
                <Title>{item.name}</Title>
                <Paragraph>{item.description}</Paragraph>
            </Card.Content>
            <Card.Cover source={require('./image.png')} />
            <Card.Actions>
                <Button>Cancel</Button>
                <Button>Ok</Button>
            </Card.Actions>
        </Card>
    )
}

const styles = StyleSheet.create({
    box: {
        // height: 100,
        // width: 300,
        margin: 5,
    },
})